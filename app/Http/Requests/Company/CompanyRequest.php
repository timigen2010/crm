<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CompanyRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CompanyRequest",
     *     type="object",
     *     @SWG\Property(property="isAdmin", type="boolean"),
     *     @SWG\Property(property="url", type="string"),
     *     @SWG\Property(property="ssl", type="string"),
     *     @SWG\Property(property="settings", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="code", type="string"),
     *              @SWG\Property(property="key", type="string"),
     *              @SWG\Property(property="value", type="string"),
     *              @SWG\Property(property="isSerialized", type="boolean")
     *          )
     *     ),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="longName", type="string"),
     *              @SWG\Property(property="keyword", type="string")
     *          )
     *     )
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'isAdmin' => 'required|boolean',
            'url' => 'required|string',
            'ssl' => 'required|string',
            'settings' => 'nullable|array',
            'settings.*.code' => 'required|string',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'required',
            'settings.*.isSerialized' => 'required|boolean',
            'descriptions' => 'nullable|array',
            'descriptions.*.languageId' => 'required|integer',
            'descriptions.*.name' => 'required|string',
            'descriptions.*.longName' => 'required|string',
            'descriptions.*.keyword' => 'required|string',
        ];
    }
}
