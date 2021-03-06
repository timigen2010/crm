<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CreateUpdateOrderRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CreateUpdateOrderRequest",
     *     type="object",
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="menuCompanyId", type="integer"),
     *     @SWG\Property(property="countPerson", type="integer"),
     *     @SWG\Property(property="countOddmoney", type="number"),
     *     @SWG\Property(property="countUncash", type="number"),
     *     @SWG\Property(property="discountCardId", type="string"),
     *     @SWG\Property(property="discountCardTransactionId", type="integer"),
     *     @SWG\Property(property="countBonus", type="number"),
     *     @SWG\Property(property="countBonusAdd", type="number"),
     *     @SWG\Property(property="countVoucher", type="number"),
     *     @SWG\Property(property="userId", type="integer"),
     *     @SWG\Property(property="lastEditorId", type="integer"),
     *     @SWG\Property(property="deliveryMethod", type="string"),
     *     @SWG\Property(property="comment", type="string"),
     *     @SWG\Property(property="total", type="number"),
     *     @SWG\Property(property="languageId", type="integer"),
     *     @SWG\Property(property="customerId", type="integer"),
     *     @SWG\Property(property="firstName", type="string"),
     *     @SWG\Property(property="lastName", type="string"),
     *     @SWG\Property(property="email", type="string"),
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="paymentFirstName", type="string"),
     *     @SWG\Property(property="paymentLastName", type="string"),
     *     @SWG\Property(property="address_1", type="string"),
     *     @SWG\Property(property="address_2", type="string"),
     *     @SWG\Property(property="coords", type="string"),
     *     @SWG\Property(property="city", type="string"),
     *     @SWG\Property(property="paymentMethod", type="string"),
     *     @SWG\Property(property="paymentCode", type="string"),
     *     @SWG\Property(property="courierId", type="integer"),
     *     @SWG\Property(property="cookComment", type="string"),
     *     @SWG\Property(property="deliveryType", type="string"),
     *     @SWG\Property(property="deliveryDay", type="string"),
     *     @SWG\Property(property="deliveryTime", type="string"),
     *     @SWG\Property(property="products", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="productId", type="integer"),
     *          @SWG\Property(property="unitClassId", type="integer"),
     *          @SWG\Property(property="discountCardId", type="string"),
     *          @SWG\Property(property="name", type="string"),
     *          @SWG\Property(property="amount", type="number"),
     *          @SWG\Property(property="discount", type="number"),
     *          @SWG\Property(property="price", type="number"),
     *          @SWG\Property(property="total", type="number"),
     *          @SWG\Property(property="key", type="string"),
     *          @SWG\Property(property="options", type="array", @SWG\Items(type="object",
     *              @SWG\Property(property="productId", type="integer"),
     *              @SWG\Property(property="amount", type="number"),
     *          )),
     *     )),
     *     @SWG\Property(property="actions", type="array", @SWG\Items(type="object",
     *          @SWG\Property(property="info", type="string"),
     *     )),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'companyId' => 'required|integer',
            'menuCompanyId' => 'required|integer',
            'countPerson' => 'required|integer',
            'countOddmoney' => 'required|numeric',
            'countUncash' => 'required|numeric',
            'countBonus' => 'nullable|numeric',
            'countBonusAdd' => 'nullable|numeric',
            'countVoucher' => 'nullable|numeric',
            'discountCardId' => 'nullable|string',
            'discountCardTransactionId' => 'nullable|integer',
            'discount' => 'nullable|numeric',
            'deliveryMethod' => 'nullable|string',
            'comment' => 'nullable|string',
            'subTotal' => 'required|numeric',
            'total' => 'required|numeric',
            'languageId' => 'required|integer',
            'customerId' => 'nullable|numeric',
            'firstName' => 'required|string',
            'lastName' => 'nullable|string',
            'email' => 'nullable|string',
            'telephone' => 'nullable|string',
            'paymentFirstName' => 'required|string',
            'paymentLastName' => 'nullable|string',
            'address_1' => 'nullable|string',
            'address_2' => 'nullable|string',
            'coords' => 'nullable|string',
            'city' => 'nullable|string',
            'paymentMethod' => 'required|string',
            'paymentCode' => 'required|string',
            'courierId' => 'nullable|integer',
            'cookComment' => 'nullable|string',
            'deliveryType' => 'required|string',
            'deliveryDay' => 'nullable|string',
            'deliveryTime' => 'nullable|string',

            'products' => 'nullable|array',
            'products.*.productId' => 'required|integer',
            'products.*.unitClassId' => 'required|integer',
            'products.*.discountCardId' => 'nullable|string',
            'products.*.name' => 'required|string',
            'products.*.amount' => 'required|numeric',
            'products.*.discount' => 'required|numeric',
            'products.*.price' => 'required|numeric',
            'products.*.total' => 'required|numeric',
            'products.*.key' => 'required|string',

            'products.*.options' => 'nullable|array',
            'products.*.options.*.productId' => 'required|integer',
            'products.*.options.*.amount' => 'required|numeric',

            'actions.*' => 'nullable|array',
            'actions.*.info' => 'required|string',
        ];
    }
}
