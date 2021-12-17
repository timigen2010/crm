<?php

namespace App\Http\Requests\Call;

use Illuminate\Foundation\Http\FormRequest;
use Swagger\Annotations as SWG;

class SetCallEventRequest extends FormRequest
{
    /**
     * @SWG\Definition(
     *     definition="SetCallEventRequest",
     *     type="object",
     *     @SWG\Property(property="event", type="string"),
     *     @SWG\Property(property="uniqueid", type="string"),
     *     @SWG\Property(property="source", type="string"),
     *     @SWG\Property(property="destination", type="string"),
     *     @SWG\Property(property="calleridname", type="string"),
     *     @SWG\Property(property="calleridnum", type="string"),
     *     @SWG\Property(property="callerid1", type="string"),
     *     @SWG\Property(property="callerid2", type="string"),
     *     @SWG\Property(property="sub_event", type="string"),
     *     @SWG\Property(property="confirm", type="string"),
     *     @SWG\Property(property="recordingfile", type="string"),
     *  )
     * @return array
     */
    public function rules(): array
    {
        return [
            'event' => 'string',
            'uniqueid' => 'string',
            'source' => 'string',
            'destination' => 'string',
            'calleridname' => 'string',
            'calleridnum' => 'string',
            'connectedlinenum' => 'string',
            'callerid1' => 'string',
            'callerid2' => 'string',
            'sub_event' => 'string',
            'confirm' => 'string',
            'recordingfile' => 'string',
            'starttime' => 'string',
            'endtime' => 'string',
            'duration' => 'string',
            'billableseconds' => 'string',
            'disposition' => 'string',
        ];
    }
}
