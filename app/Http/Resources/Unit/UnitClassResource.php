<?php

namespace App\Http\Resources\Unit;

use App\Model\Unit\Entity\UnitClassDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $unit_class_id
 * @property int $main_class_id
 * @property float $value
 * @property Collection<UnitClassDescription> $descriptions
 */
class UnitClassResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="UnitClassResource",
     *     type="object",
     *     @SWG\Property(property="unitClassId", type="integer"),
     *     @SWG\Property(property="mainClassId", type="integer"),
     *     @SWG\Property(property="value", type="string"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="unitClassDescriptionId", type="integer"),
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
            'unitClassId' => $this->unit_class_id,
            'mainClassId' => $this->main_class_id,
            'value' => $this->value,
            'descriptions' => $this->descriptions->map(
                function (UnitClassDescription $description) {
                    return [
                        'unitClassDescriptionId' => $description->unit_class_description_id,
                        'title' => $description->title,
                        'unit' => $description->unit,
                        'languageId' => $description->language_id,
                    ];
                })
        ];
    }
}
