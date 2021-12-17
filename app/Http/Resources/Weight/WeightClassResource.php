<?php

namespace App\Http\Resources\Weight;

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
 */
class WeightClassResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="WeightClassResource",
     *     type="object",
     *     @SWG\Property(property="weightClassId", type="integer"),
     *     @SWG\Property(property="mainClassId", type="integer"),
     *     @SWG\Property(property="value", type="string"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="weightClassDescriptionId", type="integer"),
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="title", type="string"),
     *              @SWG\Property(property="unit", type="string"),
     *          )
     *     ),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'weightClassId' => $this->weight_class_id,
            'mainClassId' => $this->main_class_id,
            'value' => $this->value,
            'descriptions' => $this->descriptions->map(
                function (WeightClassDescription $description) {
                    return [
                        'weightClassDescriptionId' => $description->weight_class_description_id,
                        'title' => $description->title,
                        'unit' => $description->unit,
                        'languageId' => $description->language_id,
                    ];
                })
        ];
    }
}
