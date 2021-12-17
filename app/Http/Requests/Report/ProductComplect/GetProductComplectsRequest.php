<?php

namespace App\Http\Requests\Report\ProductComplect;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetProductComplectsRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetOrdersRequest",
     *     type="object",
     *     @SWG\Property(property="orderId", type="integer"),
     *     @SWG\Property(property="orderStatusId", type="integer"),
     *     @SWG\Property(property="userGroupId", type="integer"),
     *     @SWG\Property(property="customerId", type="integer"),
     *     @SWG\Property(property="updatedAt", type="string"),
     *     @SWG\Property(property="createdAt", type="string"),
     *     @SWG\Property(property="total", type="number"),
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="page", type="integer"),
     *     @SWG\Property(property="limit", type="integer"),
     *     @SWG\Property(property="orderBy", type="string"),
     *     @SWG\Property(property="orderDirection", type="string"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
              'name' => 'nullable|string',
              'sale_able' => 'nullable|integer',
            'orderId' => 'nullable|integer',
            'orderStatusId' => 'nullable|integer',
            'userGroupId' => 'nullable|integer',
            'customerId' => 'nullable|integer',
            'companyId' => 'nullable|integer',
            'updatedAt' => 'nullable|date_format:"Y-m-d H:i:s"',
            'createdAt' => 'nullable|date_format:"Y-m-d H:i:s"',
            'total' => 'nullable|numeric',
            'page' => 'nullable|integer',
            'limit' => 'nullable|integer',
            'orderBy' => [
                'nullable',
                Rule::in([
                    'order_id'
                ]),
            ],
            'orderDirection' => [
                'nullable',
                Rule::in(['desc', 'asc']),
            ],
        ];
    }
}
