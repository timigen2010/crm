<?php

namespace App\Model\Company\Entity;

use App\Model\Product\Entity\ProductConstructor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $company_id
 * @property bool $is_admin
 * @property string $url
 * @property string $ssl
 * @property Collection<CompanySetting> $settings
 * @property Collection<CompanyDescription> $descriptions
 */
class Company extends Model
{
    protected $table = 'companies';

    protected $primaryKey = 'company_id';

    protected $fillable = ['is_admin', 'url', 'ssl'];

    public $timestamps = false;

    public function settings()
    {
        return $this->hasMany(
            CompanySetting::class,
            'company_id',
            'company_id'
        );
    }

    public function descriptions()
    {
        return $this->hasMany(
            CompanyDescription::class,
            'company_id',
            'company_id'
        );
    }

    public function productConstructors()
    {
        return $this->belongsToMany(
            ProductConstructor::class,
            'product_constructors_to_companies',
            'company_id',
            'product_constructor_id'
        );
    }

    public function getDescription(?int $languageId = null): ?CompanyDescription
    {
        /** @var CompanyDescription $description */
        if (is_null($languageId)) {
            $description = $this->descriptions->first();
        } else {
            $description = $this->descriptions->filter(
                fn(CompanyDescription $description) => $description->language_id === $languageId
            )->first();
        }
        return $description;
    }

    public function getName(?int $languageId = null): ?string
    {
        $description = $this->getDescription($languageId);
        return $description ? $description->name : null;
    }
}
