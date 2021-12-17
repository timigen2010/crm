<?php

namespace App\Model\Call\Service\SetCallEvent\SetEvent;

use App\Model\Call\Repository\DialStatusRepository;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;

class SetDial implements SetEventInterface
{
    private GetCompanyPhonelinesInterface $getPhonelines;
    private SetBEDialInterface $setBEDial;
    private DialStatusRepository $dialStatusRepository;

    public function __construct(GetCompanyPhonelinesInterface $getPhonelines, SetBEDialInterface $setBEDial, DialStatusRepository $dialStatusRepository)
    {
        $this->getPhonelines = $getPhonelines;
        $this->setBEDial = $setBEDial;
        $this->dialStatusRepository = $dialStatusRepository;
    }

    /**
     * @param Data $data
     * @return mixed
     */
    public function set(Data $data)
    {
        $keyword = $this->config->get('config_electronic_signature');

        $json = array();

        if (md5($data->event . $data->uniqueId . $keyword) == $data->confirm) {
            $phonelines = $this->getPhonelines->getPhonelines();
            switch ($data->subEvent) {
                case 'Begin':
                    $dialStatus = $this->dialStatusRepository->findOneBy(['code'=>'DialBegin']);
                    $json = $this->setBEDial->set($data, $dialStatus, $phonelines);
                    break;
                case 'End':
                    $dialStatus = $this->dialStatusRepository->findOneBy(['code'=>'DialEnd']);
                    $json = $this->setBEDial->set($data, $dialStatus, $phonelines);
                    break;
            }

        }

        return $json;
    }
}
