<?php

namespace App\Model\Company\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $company_setting_id
 * @property int $company_id
 * @property string $code
 * @property string $key
 * @property string $value
 * @property bool $is_serialized
 */
class CompanySetting extends Model
{
    protected $table = 'company_settings';

    protected $primaryKey = 'company_setting_id';

    protected $fillable = ['company_id', 'code', 'key', 'value', 'is_serialized'];

    public $timestamps = false;
}
