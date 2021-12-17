<?php

namespace App\Model\Currency\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $currency_description_id
 * @property int $currency_id
 * @property int $language_id
 * @property string $name
 * @property string $symbol_left
 * @property string $symbol_right
 */
class CurrencyDescription extends Model
{
    protected $table = 'currency_descriptions';

    protected $primaryKey = 'currency_description_id';

    protected $fillable = ['currency_id', 'language_id', 'name', 'symbol_left', 'symbol_right'];

    public $timestamps = false;
}
