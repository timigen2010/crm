<?php

namespace App\Http\Requests\Call;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swagger\Annotations as SWG;

class GetCallActivitiesRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="GetCallActivitiesRequest",
     *     type="object",
     *     @SWG\Property(property="source", type="string"),
     *     @SWG\Property(property="destination", type="string"),
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="statusDisposition", type="integer"),
     *     @SWG\Property(property="dateStart", type="string"),
     *     @SWG\Property(property="dateEnd", type="string"),
     *     @SWG\Property(property="orderBy", type="string"),
     *     @SWG\Property(property="orderDirection", type="string"),
     *  )
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'source' => 'nullable|string',
            'destination' => 'nullable|string',
            'companyId' => 'nullable|integer',
            'statusDisposition' => 'nullable|integer',
            'dateStart' => 'nullable|string',
            'dateEnd' => 'nullable|string',
            'orderBy' => [
                'nullable',
                Rule::in([
                    'call_activities_id', 'source',
                    'destination', 'company_id', 'disposition',
                    'date_start', 'date_end'
                ]),
            ],
            'orderDirection' => [
                'nullable',
                Rule::in(['desc', 'asc']),
            ],
        ];
    }
}
