<?php

namespace App\Model\Order\Service\CreateUpdate;

use App\Model\Company\Entity\CompanySetting;
use App\Model\Company\Repository\CompanyRepository;
use App\Model\Company\Repository\CompanySettingRepository;
use App\Model\Currency\Entity\Currency;
use App\Model\Currency\Repository\CurrencyRepository;
use App\Model\Customer\Repository\CustomerRepository;
use App\Model\DB\Repository\ReceivingDBSyncRepository;
use App\Model\DB\Service\DispatchingSync\DispatchingDBSyncInterface;
use App\Model\Discount\Entity\DiscountCard;
use App\Model\Discount\Repository\DiscountCardRepository;
use App\Model\Discount\Service\CardOperation\Factory\CardOperationFactoryInterface;
use App\Model\Discount\Service\CardTransaction\Factory\CardTransactionFactoryInterface;
use App\Model\Language\Repository\LanguageRepository;
use App\Model\Order\Entity\Order;
use App\Model\Order\Entity\OrderStatus;
use App\Model\Order\Repository\OrderCookCommentRepository;
use App\Model\Order\Repository\OrderCourierRepository;
use App\Model\Order\Repository\OrderDeliveryTimeRepository;
use App\Model\Order\Repository\OrderOptionRepository;
use App\Model\Order\Repository\OrderProductRepository;
use App\Model\Order\Repository\OrderTotalRepository;
use App\Model\Order\Service\Action\OrderActionFactoryInterface;
use App\Model\Order\Service\Action\Data as OrderActionFactoryData;
use App\Model\Order\Service\CookComment\Factory\OrderCookCommentFactoryInterface;
use App\Model\Order\Service\CookComment\Factory\Data as OrderCookCommentFactoryData;
use App\Model\Order\Service\Courier\Factory\OrderCourierFactoryInterface;
use App\Model\Order\Service\Courier\Factory\Data as OrderCourierFactoryData;
use App\Model\Order\Service\Customer\Factory\OrderCustomerFactoryInterface;
use App\Model\Order\Service\Customer\Factory\Data as OrderCustomerFactoryData;
use App\Model\Order\Service\DeliveryTime\Factory\OrderDeliveryTimeFactoryInterface;
use App\Model\Order\Service\DeliveryTime\Factory\Data as OrderDeliveryTimeFactoryData;
use App\Model\Order\Service\Factory\OrderFactoryInterface;
use App\Model\Order\Service\Factory\Data as OrderFactoryData;
use App\Model\Order\Service\History\Factory\OrderHistoryFactoryInterface;
use App\Model\Order\Service\History\Factory\Data as OrderHistoryFactoryData;
use App\Model\Order\Service\OrderOption\Factory\OrderOptionFactoryInterface;
use App\Model\Order\Service\OrderOption\Factory\Data as OrderOptionFactoryData;
use App\Model\Order\Service\Payment\Factory\OrderPaymentFactoryInterface;
use App\Model\Order\Service\Payment\Factory\Data as OrderPaymentFactoryData;
use App\Model\Order\Service\Product\Factory\OrderProductFactoryInterface;
use App\Model\Order\Service\Product\Factory\Data as OrderProductFactoryData;
use App\Model\Order\Service\Total\Factory\OrderTotalFactoryInterface;
use App\Model\Order\Service\Total\Factory\Data as OrderTotalFactoryData;
use Carbon\Carbon;
use DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

/**
 * @TODO need add companies in customer
 * @TODO need add courier
*/
class CreateUpdateOrder implements CreateUpdateOrderInterface
{
    private OrderFactoryInterface $orderFactory;
    private OrderCustomerFactoryInterface $orderCustomerFactory;
    private OrderPaymentFactoryInterface $orderPaymentFactory;
    private OrderCourierFactoryInterface $orderCourierFactory;
    private OrderCourierRepository $orderCourierRepository;
    private OrderCookCommentFactoryInterface $orderCookCommentFactory;
    private OrderCookCommentRepository $orderCookCommentRepository;
    private OrderDeliveryTimeFactoryInterface $orderDeliveryTimeFactory;
    private OrderDeliveryTimeRepository $orderDeliveryTimeRepository;
    private OrderProductRepository $orderProductRepository;
    private OrderOptionRepository $orderOptionRepository;
    private OrderProductFactoryInterface $orderProductFactory;
    private OrderOptionFactoryInterface $orderOptionFactory;
    private OrderTotalRepository $orderTotalRepository;
    private OrderTotalFactoryInterface $orderTotalFactory;
    private OrderHistoryFactoryInterface $orderHistoryFactory;
    private OrderActionFactoryInterface $orderActionFactory;
    private CompanySettingRepository $companySettingRepository;
    private CurrencyRepository $currencyRepository;
    private DiscountCardRepository $discountCardRepository;
    private CardOperationFactoryInterface $cardOperationFactory;
    private CardTransactionFactoryInterface $cardTransactionFactory;
    private DispatchingDBSyncInterface $dispatchingDBSync;
    private ReceivingDBSyncRepository $receivingDBSyncRepository;
    private CompanyRepository $companyRepository;
    private CustomerRepository $customerRepository;


    public function __construct(OrderFactoryInterface $orderFactory,
                                OrderCustomerFactoryInterface $orderCustomerFactory,
                                OrderPaymentFactoryInterface $orderPaymentFactory,
                                OrderCourierFactoryInterface $orderCourierFactory,
                                OrderCourierRepository $orderCourierRepository,
                                OrderCookCommentFactoryInterface $orderCookCommentFactory,
                                OrderCookCommentRepository $orderCookCommentRepository,
                                OrderDeliveryTimeFactoryInterface $orderDeliveryTimeFactory,
                                OrderDeliveryTimeRepository $orderDeliveryTimeRepository,
                                OrderProductRepository $orderProductRepository,
                                OrderOptionRepository $orderOptionRepository,
                                OrderProductFactoryInterface $orderProductFactory,
                                OrderOptionFactoryInterface $orderOptionFactory,
                                OrderTotalRepository $orderTotalRepository,
                                OrderTotalFactoryInterface $orderTotalFactory,
                                OrderHistoryFactoryInterface $orderHistoryFactory,
                                OrderActionFactoryInterface $orderActionFactory,
                                CompanySettingRepository $companySettingRepository,
                                CurrencyRepository $currencyRepository,
                                DiscountCardRepository $discountCardRepository,
                                CardOperationFactoryInterface $cardOperationFactory,
                                CardTransactionFactoryInterface $cardTransactionFactory,
                                CompanyRepository $companyRepository,
                                CustomerRepository $customerRepository)
    {
        $this->orderFactory = $orderFactory;
        $this->orderCustomerFactory = $orderCustomerFactory;
        $this->orderPaymentFactory = $orderPaymentFactory;
        $this->orderCourierFactory = $orderCourierFactory;
        $this->orderCourierRepository = $orderCourierRepository;
        $this->orderCookCommentFactory = $orderCookCommentFactory;
        $this->orderCookCommentRepository = $orderCookCommentRepository;
        $this->orderDeliveryTimeFactory = $orderDeliveryTimeFactory;
        $this->orderDeliveryTimeRepository = $orderDeliveryTimeRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->orderOptionRepository = $orderOptionRepository;
        $this->orderProductFactory = $orderProductFactory;
        $this->orderOptionFactory = $orderOptionFactory;
        $this->orderTotalRepository = $orderTotalRepository;
        $this->orderTotalFactory = $orderTotalFactory;
        $this->orderHistoryFactory = $orderHistoryFactory;
        $this->orderActionFactory = $orderActionFactory;
        $this->companySettingRepository = $companySettingRepository;
        $this->currencyRepository = $currencyRepository;
        $this->discountCardRepository = $discountCardRepository;
        $this->cardOperationFactory = $cardOperationFactory;
        $this->cardTransactionFactory = $cardTransactionFactory;
        $this->companyRepository = $companyRepository;
        $this->customerRepository = $customerRepository;
    }

    public function handle(Data $data, Order $editOrder = null)
    {
        /** @var CompanySetting $currencySetting */
        $currencySetting = $this->companySettingRepository->findOneByCompanyIdAndKey(
            $data->companyId,
            'config_admin_currency'
        );
        if (empty($currencySetting)) {
            throw new DomainException("Currency not found for company #{$data->companyId}");
        }
        /** @var Currency $currency */
        $currency = $this->currencyRepository->findOneBy(["currency_id" => $currencySetting->value]);
        $transaction = DB::transaction(function () use ($data, $editOrder, $currency, &$dispatchingQuery, &$newOrderId) {

            $deliveryMethod = "self";
            if(in_array($data->deliveryMethod, ["self", "visitor"])){
                $deliveryMethod = $data->deliveryMethod;
            } elseif ($data->deliveryMethod){
                $deliveryMethod = 'delivery';
                $data->courierId = $data->deliveryMethod;
            }


            $orderFactoryData = new OrderFactoryData(
                $data->companyId,
                $data->menuCompanyId,
                $data->countPerson,
                $data->countOddmoney,
                $data->countUncash,
                $data->discountCardId,
                $data->discountCardTransactionId,
                $data->countBonus,
                $data->countBonusAdd,
                $data->countVoucher,
                $data->userId,
                $data->lastEditorId,
                $deliveryMethod,
                $data->comment,
                $data->total,
                OrderStatus::STATUS_CREATED_UPDATED,
                $data->languageId,
                $currency->currency_id,
                $currency->code,
                $currency->value
            );
            if($editOrder){
                $orderStatusId = $editOrder->orderHistories->sortByDesc('order_history_id');
                foreach ($orderStatusId as $orderHistory){
                    if($orderHistory->order_status_id){
                        $orderStatusId = $orderHistory->order_status_id;
                        break;
                    }
                }
                $orderFactoryData->orderStatusId = $orderStatusId;
            }
            $order = $this->orderFactory->create($orderFactoryData, $editOrder);
            $this->orderCustomerFactory->create(new OrderCustomerFactoryData(
                $order->order_id,
                $data->customerId,
                $data->firstName,
                $data->lastName,
                $data->email,
                $data->telephone
            ));
            $this->orderPaymentFactory->create(new OrderPaymentFactoryData(
                $order->order_id,
                $data->paymentFirstName,
                $data->paymentLastName,
                $data->address_1,
                $data->address_2,
                $data->coords,
                $data->city,
                $data->paymentMethod,
                $data->paymentCode
            ));

            $this->orderCourierRepository->setDeletedByOrderId($order->order_id);
            if ($data->courierId) {
                $this->orderCourierFactory->create(new OrderCourierFactoryData(
                    $order->order_id,
                    $data->courierId
                ));
            }

            if ($data->cookComment) {
                $this->orderCookCommentRepository->deleteByOrderId($order->order_id);
                $this->orderCookCommentFactory->create(new OrderCookCommentFactoryData(
                    $order->order_id,
                    $data->cookComment
                ));

            }
            if ($this->hasDeliveryData($data)) {
                $this->orderDeliveryTimeRepository->deleteByOrderId($order->order_id);
                $this->orderDeliveryTimeFactory->create(new OrderDeliveryTimeFactoryData(
                    $order->order_id,
                    $data->deliveryType,
                    $data->deliveryDay,
                    $data->deliveryTime
                ));

            }
            $this->orderProductRepository->setDeletedByOrderId($order->order_id);
            $this->orderOptionRepository->deleteByOrderId($order->order_id);
            if ($data->products) {

                foreach ($data->products as $productIndex=>$product) {
                    $this->orderProductFactory->create(new OrderProductFactoryData(
                        $order->order_id,
                        $product["productId"],
                        $product["unitClassId"],
                        $product["discountCardId"],
                        $currency->currency_id,
                        $product["name"],
                        $product["amount"],
                        $product["discount"],
                        $product["price"],
                        $product["total"]
                    ));

                    if (!empty($product["options"])) {
                        foreach ($product["options"] as $option) {

                            $this->orderOptionFactory->create(new OrderOptionFactoryData(
                                $order->order_id,
                                $product["productId"],
                                $productIndex,
                                $option["productId"],
                                $option["amount"],
                            ));
                        }
                    }
                }

            }
            $this->orderTotalRepository->deleteByOrderId($order->order_id);
            $totals = [
                [
                    "code" => "cash",
                    "title" => "Наличка",
                    "value" => $data->countOddmoney
                ],
                [
                    "code" => "uncash",
                    "title" => "Терминал",
                    "value" => $data->countUncash ?? 0
                ],
                [
                    "code" => "discount",
                    "title" => "Бонус-карта",
                    "value" => $data->discount ?? 0
                ],
                [
                    "code" => "sub_total",
                    "title" => "Сумма",
                    "value" => $data->subTotal
                ],
                [
                    "code" => "total",
                    "title" => "Итого",
                    "value" => $data->total
                ]
            ];

//           TODO::перенести в сервис бонус-карт
            if($data->discountCardId){

//            TODO::перененсти в настройки max_discount_percent и bonus_percent
                $bonusPercent = 10;
                $maxDiscountPercent = 25;

//            TODO:: перенести в сервис
                $discountCard = $this->discountCardRepository->findOneById($data->discountCardId);

                $discount = $this->calcDiscount($data->subTotal, $discountCard->balance, (int) $data->discount * 100, $bonusPercent, $maxDiscountPercent);

                $balanceOld = $discountCard->balance;
                $discountCard->balance -= $discount['bonusesUse'];
                $discountCard->save();

                $cardOperation = $this->cardOperationFactory->create(new \App\Model\Discount\Service\CardOperation\Factory\Data(
                    $data->discountCardId,
                    $order->order_id,
                    $data->subTotal,
                    $discount['discount'],
                    $discount['costDiscount'],
                    $data->userId,
                    $discount['bonusesAdd'],
                    $discount['bonusesUse'],
                    'buy'
                ));

                $cardTransaction = $this->cardTransactionFactory->create(new \App\Model\Discount\Service\CardTransaction\Factory\Data(
                    $data->discountCardId,
                    $data->userId,
                    $cardOperation->discount_card_operation_id,
                    -(int) $discount['bonusesUse'],
                    intval($balanceOld - $discount['bonusesUse']),
                    "finished"
                ));

                $balanceNew = 0;
                $status = 'wait';

                $cardTransactionBonusAdd = $this->cardTransactionFactory->create(new \App\Model\Discount\Service\CardTransaction\Factory\Data(
                    $data->discountCardId,
                    $data->userId,
                    $cardOperation->discount_card_operation_id,
                    (int) $discount['bonusesAdd'],
                    $balanceNew,
                    $status
                ));

                $order->discount_card_transaction_id = $cardTransactionBonusAdd->discount_card_transaction_id;
                $order->count_bonus = $discount['bonusesUse'] / 100;
                $order->save();

            }

            foreach ($totals as $total) {
                $this->orderTotalFactory->create(new OrderTotalFactoryData(
                    $order->order_id,
                    $total["code"],
                    $total["title"],
                    $total["value"],
                ));

            }
            $this->orderHistoryFactory->create(new OrderHistoryFactoryData(
                $order->order_id,
                $data->userId,
                OrderStatus::STATUS_CREATED_UPDATED,
                "",
                []
            ));

            if ($data->actions) {
                foreach ($data->actions as $action) {
                    $this->orderActionFactory->create(new OrderActionFactoryData(
                        $order->order_id,
                        $data->userId,
                        $action["info"]
                    ));
                }
            }
            $newOrderId = $order->order_id;
            return $order;
        });

        return $transaction;
    }

    private function hasDeliveryData(Data $data)
    {
        return $data->deliveryType && $data->deliveryDay && $data->deliveryTime;
    }

//  TODO::перенести в сервис бонус-карт
    private function calcDiscount(float $summ, float $balance, float $use_bonuses,
                                  float $bonus_percent, float $max_discount_percent){
        $return = [];
        $max_discount = ( int ) floor ( $summ * $max_discount_percent / 100 ) * 100;
        $return['bonusesUse'] = ($max_discount > $balance) ? $balance : $max_discount;
        if ($return['bonusesUse'] > $use_bonuses) {
            $return['bonusesUse'] = $use_bonuses;
        }
        $return['discount'] = floor($return['bonusesUse'] / 100);
        $return['costDiscount'] = $summ - $return['discount'];
        $return['bonusesAdd'] = floor ( (( int ) floor ( $return['costDiscount'])) * $bonus_percent );
        $return['balanceNew'] = $balance - $return['bonusesUse'] + $return['bonusesAdd'];
        return $return;
    }
}
