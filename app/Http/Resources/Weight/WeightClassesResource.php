<?php

namespace App\Http\Resources\Weight;

use App\Model\Weight\Entity\WeightClass;
use App\Model\Weight\Entity\WeightClassDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $weight_class_id
 * @property int $main_class_id
 * @property float $value
 * @property Collection<WeightClassDescription> $descriptions
 * @property WeightClass $mainWeightClass
 * @method WeightClassDescription|null getDescription(?string $languageId)
 */
class WeightClassesResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="WeightClassesResource",
     *     type="object",
     *     @SWG\Property(property="weightClassId", type="integer"),
     *     @SWG\Property(property="mainClassUnit", type="string"),
     *     @SWG\Property(property="value", type="string"),
     *     @SWG\Property(property="title", type="string"),
     *     @SWG\Property(property="unit", type="string"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $description = $this->getDescription($request->query->get('languageId'));
        return [
            'weightClassId' => $this->weight_class_id,
            'mainClassUnit' => $this->main_class_id ? $this->mainWeightClass->getUnit($request->query->get('languageId')) : null,
            'value' => $this->value,
            'title' => $description ? $description->title : null,
            'unit' => $description ? $description->unit : null
        ];
    }
}
