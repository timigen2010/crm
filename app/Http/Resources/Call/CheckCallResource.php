<?php

namespace App\Http\Resources\Call;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $callId
 * @property int $customerId
 * @property int $companyId
 * @property boolean $isIn
 */
class CheckCallResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CallActivityResource",
     *     type="object",
     *     @SWG\Property(property="callId", type="integer"),
     *     @SWG\Property(property="customerId", type="integer"),
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="isIn", type="boolean")
     *  )
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'callId' => $this->callId,
            'customerId' => $this->customerId,
            'companyId' => $this->companyId,
            'isIn' => $this->isIn,
        ];
    }
}
