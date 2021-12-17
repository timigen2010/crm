<?php

namespace App\Model\Company\Entity\Phoneline;

use App\Model\Company\Entity\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $company_phoneline_id
 * @property int $company_id
 * @property Collection<CompanyPhonelineDescription> $descriptions
 */
class CompanyPhoneline extends Model
{
    protected $table = 'company_phonelines';

    protected $primaryKey = 'company_phoneline_id';

    protected $fillable = ['company_id', 'keyword'];

    public $timestamps = false;

    public function descriptions()
    {
        return $this->hasMany(
            CompanyPhonelineDescription::class,
            'company_phoneline_id',
            'company_phoneline_id'
        );
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function getName(?int $languageId = null): ?string
    {
        $description = $this->getDescription($languageId);
        return $description ? $description->name : null;
    }

    public function getDescription(?int $languageId = null): ?CompanyPhonelineDescription
    {
        /** @var CompanyPhonelineDescription $description */
        if (is_null($languageId)) {
            $description = $this->descriptions->first();
        } else {
            $description = $this->descriptions->find(
                fn(CompanyPhonelineDescription $description) => $description->language_id === $languageId
            );
        }
        return $description;
    }
}
