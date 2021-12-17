<?php

namespace App\Model\Currency\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $currency_id
 * @property int $main_currency_id
 * @property bool $deleted
 * @property float $value
 * @property string $code
 * @property int $decimal_place
 * @property bool $status
 * @property Collection<CurrencyDescription> $descriptions
 * @property Collection<Currency> $children
 * @property Currency $mainCurrency
 * @property Carbon $created_at;
 * @property Carbon $updated_at;
 */
class Currency extends Model
{
    protected $table = 'currencies';

    protected $primaryKey = 'currency_id';

    protected $fillable = ['main_currency_id', 'deleted', 'value', 'code', 'decimal_place', 'status'];

    public $timestamps = true;

    public function descriptions()
    {
        return $this->hasMany(CurrencyDescription::class, 'currency_id', 'currency_id');
    }

    public function children()
    {
        return $this->hasMany(Currency::class, 'main_currency_id', 'currency_id');
    }

    public function mainCurrency()
    {
        return $this->belongsTo(Currency::class, 'main_currency_id', 'currency_id');
    }

    public function getName(?int $languageId = null): ?string
    {
        /** @var CurrencyDescription $description */
        if (is_null($languageId)) {
            $description = $this->descriptions->first();
        } else {
            $description = $this->descriptions->find(
                fn(CurrencyDescription $description) => $description->language_id === $languageId
            );
        }
        return $description ? $description->name : null;
    }
}
