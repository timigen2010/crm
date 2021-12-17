<?php

namespace App\Http\Resources\Currency;

use App\Model\Currency\Entity\Currency;
use App\Model\Currency\Entity\CurrencyDescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $currency_id
 * @property int $main_currency_id
 * @property float $value
 * @property string $code
 * @property Collection<CurrencyDescription> $descriptions
 * @property Currency $mainCurrency
 * @property Carbon $updated_at;
 * @method getName(?string $languageId): string|null
 */
class CurrenciesResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CurrenciesResource",
     *     type="object",
     *     @SWG\Property(property="currencyId", type="integer"),
     *     @SWG\Property(property="mainCurrencyCode", type="string"),
     *     @SWG\Property(property="value", type="float"),
     *     @SWG\Property(property="code", type="string"),
     *     @SWG\Property(property="updatedAt", type="string"),
     *     @SWG\Property(property="name", type="string"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'currencyId' => $this->currency_id,
            'mainCurrencyCode' => $this->main_currency_id ? $this->mainCurrency->code : null,
            'value' => $this->value,
            'code' => $this->code,
            'updatedAt' => $this->updated_at,
            'name' => $this->getName($request->query->get('languageId'))
        ];
    }
}
