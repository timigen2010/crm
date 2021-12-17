<?php

namespace App\Model\Call\Service\SetCallEvent;

use App\Model\Call\Repository\CallActivityRepository;
use App\Model\Call\Repository\DialStatusRepository;
use App\Model\Call\Service\Factory\CallActivityFactoryAbstract;
use App\Model\Call\Service\SetCallEvent\GetPhoneEntity\GetPhoneEntityInterface;
use App\Model\Call\Service\SetCallEvent\SetEvent\Data;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBEDialInterface;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetBridge;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetCdr;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetDial;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetEvent;
use App\Model\Call\Service\SetCallEvent\SetEvent\SetHangup;
use App\Model\Company\Repository\CompanyRepository;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;
use App\Model\Customer\Repository\CustomerRepository;
use App\Service\Phone\Clean\CleanPhoneInterface;
use Illuminate\Support\Facades\Log;

class SetCallEvent implements SetCallEventInterface
{
    private GetCompanyPhonelinesInterface $getPhonelines;
    private SetBEDialInterface $setBEDial;
    private DialStatusRepository $dialStatusRepository;
    private GetPhoneEntityInterface $getPhoneEntity;
    private CleanPhoneInterface $cleanPhone;
    private CallActivityRepository $callActivityRepository;
    private CallActivityFactoryAbstract $callActivityFactory;
    private CustomerRepository $customerRepository;
    private CompanyRepository $companyRepository;

    public function __construct(GetCompanyPhonelinesInterface $getPhonelines, SetBEDialInterface $setBEDial, DialStatusRepository $dialStatusRepository, GetPhoneEntityInterface $getPhoneEntity, CleanPhoneInterface $cleanPhone, CallActivityRepository $callActivityRepository, CallActivityFactoryAbstract $callActivityFactory, CustomerRepository $customerRepository, CompanyRepository $companyRepository)
    {
        $this->getPhonelines = $getPhonelines;
        $this->setBEDial = $setBEDial;
        $this->dialStatusRepository = $dialStatusRepository;
        $this->getPhoneEntity = $getPhoneEntity;
        $this->cleanPhone = $cleanPhone;
        $this->callActivityRepository = $callActivityRepository;
        $this->callActivityFactory = $callActivityFactory;
        $this->customerRepository = $customerRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function setCallEvent(Data $data)
    {

        $keyword = 'oijf894ur98alc'; //электронная подпись из настроек
        $result = null;

        $json = ['result' => 1]; // result отличный от нуля сигнализирует о наличии ошибки
        switch ($data->event) {
            case 'Cdr': //(поступает после окончания звонка)
                if($data->source != $data->destination){
                    $result = (new SetEvent(new SetCdr($this->getPhoneEntity, $this->callActivityRepository, $this->cleanPhone, $this->callActivityFactory, $this->customerRepository, $this->companyRepository)))->set($data);
                }
                $json = $this->formResult($data, $keyword);
                break;
            case 'Dial': //(поступает при первой попытке осуществить вызов - условно первый гудок)

                $json = (new SetEvent(new SetDial($this->getPhonelines, $this->setBEDial, $this->dialStatusRepository)))->set($data);
                break;
            case 'DialBegin':
                $data->subEvent = 'Begin';
                $json = (new SetEvent(new SetDial($this->getPhonelines, $this->setBEDial, $this->dialStatusRepository)))->set($data);
                break;
            case 'DialEnd':
                $data->subEvent = 'End';
                $json = (new SetEvent(new SetDial($this->getPhonelines, $this->setBEDial, $this->dialStatusRepository)))->set($data);
                break;
            case 'Hangup': //(поступает по окончанию звонка раздельно для обоих абонентов, входящий и исходящий в событии меняются местами)

                if($data->callerIdNum != $data->connectedLineNum
                    && $data->callerIdNum
                    && $data->connectedLineNum
                    && $data->connectedLineNum != '<unknown>'
                    && $data->callerIdNum != '<unknown>'){
                    $result = (new SetEvent(new SetHangup($this->getPhoneEntity, $this->callActivityRepository, $this->cleanPhone, $this->customerRepository, $this->companyRepository)))->set($data);
                }
                $json = $this->formResult($data, $keyword);
                break;
            case 'Bridge': //(поступает поcле соединения)
                if($data->callerId1 != $data->callerId2){
                    $result = (new SetEvent(new SetBridge($this->getPhoneEntity, $this->callActivityRepository, $this->callActivityFactory, $this->dialStatusRepository, $this->cleanPhone)))->set($data);
                }
                $json = $this->formResult($data, $keyword);
                break;
            default :
                if(md5($data->event . $data->uniqueId . $keyword) == $data->confirm){
                    //
                    // формируем "подпись" */
                    $json['event'] = $data->event;
                    // Событие которе не опознали не подтверждаем ненулевой result
                    $json['result'] = 1;
                    // и не подписываем
                    // $json['confirm'] = md5($keyword . $post['uniqueid']  . $post['event']);
                }
                break;
        }
        return $json;
    }

    /**
     * @param Data $data
     * @param string $keyword
     * @return mixed
     */
    private function formResult(Data $data, string $keyword){
        $json = ['result' => 1];

        if(md5($data->event . $data->uniqueId . $keyword) == $data->confirm){
            //
            // Обработка данных
            // Формирования ответа о успешной
            $json['result'] = 0;

            // Возвращаем uniqueid обработанных данных
            $json['uniqueid'] = $data->uniqueId;
            $json['event'] = $data->event;

            // формируем "подпись"
            $json['confirm'] = md5($keyword . $data->uniqueId . $data->event);
        }

        return $json;
    }
}
