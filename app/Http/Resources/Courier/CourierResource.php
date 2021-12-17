<?php

namespace App\Http\Resources\Courier;

use App\Model\Company\Entity\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $courier_id
 * @property string $name
 * @property string $telephone
 * @property float $percent
 * @property bool $deleted
 * @property Collection<Company> $companies
 */
class CourierResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CourierResource",
     *     type="object",
     *     @SWG\Property(property="courierId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="telephone", type="string"),
     *     @SWG\Property(property="percent", type="float"),
     *     @SWG\Property(property="deleted", type="bool"),
     *     @SWG\Property(property="companies", type="array",
     *          @SWG\Items(type="integer")
     *      )
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'courierId' => $this->courier_id,
            'name' => $this->name,
            'telephone' => $this->telephone,
            'percent' => $this->percent,
            'deleted' => $this->deleted,
            'companies' => $this->companies->map(
                function (Company $company) {
                    return $company->company_id;
                }
            )
        ];
    }
}
