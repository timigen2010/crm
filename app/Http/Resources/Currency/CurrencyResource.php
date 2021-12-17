<?php

namespace App\Http\Resources\Currency;

use App\Model\Currency\Entity\CurrencyDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $currency_id
 * @property int $main_currency_id
 * @property bool $deleted
 * @property float $value
 * @property string $code
 * @property int $decimal_place
 * @property bool $status
 * @property Collection<CurrencyDescription> $descriptions
 */
class CurrencyResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CurrencyResource",
     *     type="object",
     *     @SWG\Property(property="currencyId", type="integer"),
     *     @SWG\Property(property="mainCurrencyId", type="integer"),
     *     @SWG\Property(property="value", type="float"),
     *     @SWG\Property(property="code", type="string"),
     *     @SWG\Property(property="decimalPlace", type="integer"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="currencyDescriptionId", type="integer"),
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="symbolLeft", type="string"),
     *              @SWG\Property(property="symbolRight", type="string"),
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
            'currencyId' => $this->currency_id,
            'mainCurrencyId' => $this->main_currency_id,
            'value' => $this->value,
            'code' => $this->code,
            'decimalPlace' => $this->decimal_place,
            'status' => $this->status,
            'descriptions' => $this->descriptions->map(
                function (CurrencyDescription $description) {
                    return [
                        'currencyDescriptionId' => $description->currency_description_id,
                        'name' => $description->name,
                        'symbolLeft' => $description->symbol_left,
                        'symbolRight' => $description->symbol_right,
                        'languageId' => $description->language_id,
                    ];
                })
        ];
    }
}
