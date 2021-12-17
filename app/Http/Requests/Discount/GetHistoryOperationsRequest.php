<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetHistoryOperationsRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetHistoryOperationsRequest",
     *     type="object",
     *     @SWG\Property(property="page", type="integer"),
     *     @SWG\Property(property="limit", type="integer"),
     *     @SWG\Property(property="type", type="string"),
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'page' => 'nullable|integer',
            'limit' => 'nullable|integer',
            'type' => [
                'nullable',
                Rule::in(['activate', 'buy', 'add', 'rebind', 'deactivate']),
            ],
        ];
    }
}
