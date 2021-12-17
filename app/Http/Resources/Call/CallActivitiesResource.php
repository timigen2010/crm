<?php

namespace App\Http\Resources\Call;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $call_activity_id
 * @property string $source
 * @property string $destination
 * @property int $company_id
 * @property int $disposition
 * @property string $date_start
 * @property string $date_end
 * @property int $duration
 */
class CallActivitiesResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CallActivitiesResource",
     *     type="object",
     *     @SWG\Property(property="source", type="string"),
     *     @SWG\Property(property="destination", type="string"),
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="disposition", type="integer"),
     *     @SWG\Property(property="dateStart", type="string"),
     *     @SWG\Property(property="dateEnd", type="string"),
     *     @SWG\Property(property="duration", type="integer"),
     *  )
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'callActivityId' => $this->call_activity_id,
            'source' => $this->source,
            'destination' => $this->destination,
            'companyId' => $this->company_id,
            'disposition' => $this->disposition,
            'dateStart' => $this->date_start,
            'dateEnd' => $this->date_end,
            'duration' => $this->duration,
        ];
    }
}
