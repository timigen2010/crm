<?php

namespace App\Model\Company\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $company_description_id
 * @property int $company_id
 * @property int $language_id
 * @property string $name
 * @property string $long_name
 * @property string $keyword
 */
class CompanyDescription extends Model
{
    protected $table = 'company_descriptions';

    protected $primaryKey = 'company_description_id';

    protected $fillable = ['company_id', 'language_id', 'name', 'long_name', 'keyword'];

    public $timestamps = false;
}
