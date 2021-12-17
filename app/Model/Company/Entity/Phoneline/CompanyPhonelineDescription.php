<?php

namespace App\Model\Company\Entity\Phoneline;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $company_phoneline_description_id
 * @property int $company_phoneline_id
 * @property string $name
 * @property int $language_id
 */
class CompanyPhonelineDescription extends Model
{
    protected $table = 'company_phoneline_descriptions';

    protected $primaryKey = 'company_phoneline_description_id';

    protected $fillable = ['company_phoneline_id', 'name', 'language_id'];

    public $timestamps = false;
}
