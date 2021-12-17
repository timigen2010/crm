<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CompanyPhonelineRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CompanyPhonelineRequest",
     *     type="object",
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="keyword", type="string"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="languageId", type="integer")
     *          )
     *     )
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'companyId' => 'required|integer',
            'keyword' => 'required|string',
            'descriptions' => 'nullable|array',
            'descriptions.*.name' => 'required|string',
            'descriptions.*.languageId' => 'required|integer',
        ];
    }
}
