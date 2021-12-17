<?php

namespace App\Http\Resources\Unit;

use App\Model\Unit\Entity\UnitClass;
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
 * @property UnitClass $mainUnitClass
 * @method UnitClassDescription|null getDescription(?string $languageId)
 */
class UnitClassesResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="UnitClassesResource",
     *     type="object",
     *     @SWG\Property(property="unitClassId", type="integer"),
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
            'unitClassId' => $this->unit_class_id,
            'mainClassUnit' => $this->main_class_id ? $this->mainUnitClass->getUnit($request->query->get('languageId')) : null,
            'value' => $this->value,
            'title' => $description ? $description->title : null,
            'unit' => $description ? $description->unit : null
        ];
    }
}
