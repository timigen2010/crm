<?php

namespace App\Http\Requests\Call;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class CallActivityRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="CallActivityRequest",
     *     type="object",
     *     @SWG\Property(property="sourceType", type="integer"),
     *     @SWG\Property(property="sourceId", type="integer"),
     *     @SWG\Property(property="source", type="string"),
     *     @SWG\Property(property="destinationType", type="integer"),
     *     @SWG\Property(property="destinationId", type="integer"),
     *     @SWG\Property(property="destination", type="string"),
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="companyPhonelineId", type="integer"),
     *     @SWG\Property(property="phoneline", type="string"),
     *     @SWG\Property(property="comment", type="string"),
     *     @SWG\Property(property="dateStart", type="string"),
     *     @SWG\Property(property="dateEnd", type="string"),
     *     @SWG\Property(property="duration", type="integer"),
     *     @SWG\Property(property="durationLive", type="integer"),
     *     @SWG\Property(property="record", type="string"),
     *     @SWG\Property(property="uniqueId", type="string"),
     *     @SWG\Property(property="disposition", type="integer"),
     *     @SWG\Property(property="statusDial", type="integer"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'sourceType' => 'required|integer',
            'sourceId' => 'required|integer',
            'source' => 'required|string',
            'destinationType' => 'required|integer',
            'destinationId' => 'required|integer',
            'destination' => 'required|string',
            'companyId' => 'required|integer',
            'companyPhonelineId' => 'integer',
            'phoneline' => 'string',
            'comment' => 'required|string',
            'starttime' => 'required|string',
            'endtime' => 'string',
            'duration' => 'integer',
            'billableseconds' => 'integer',
            'record' => 'string',
            'uniqueId' => 'string',
            'disposition' => 'integer',
            'statusDial' => 'required|integer',
        ];
    }
}
