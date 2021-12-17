<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;

class GetDirectoriesRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'isLanguages' => 'nullable|boolean',
            'isCategoryBadges' => 'nullable|boolean',
            'isCategories' => 'nullable|boolean',
            'isCompanies' => 'nullable|boolean',
            'isMenus' => 'nullable|boolean',
            'isCurrencies' => 'nullable|boolean',
            'isUnitClasses' => 'nullable|boolean',
            'isWeightClasses' => 'nullable|boolean',
            'isProductTypes' => 'nullable|boolean',
        ];
    }
}
