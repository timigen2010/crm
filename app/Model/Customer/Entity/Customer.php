<?php

namespace App\Model\Customer\Entity;

use App\Model\Company\Entity\Company;
use App\Model\Customer\Entity\Group\CustomerGroup;
use App\Model\Discount\Entity\DiscountCard;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $customer_id
 * @property int $customer_group_id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property bool $newsletter
 * @property bool $status
 * @property CustomerGroup $customerGroup
 * @property Collection<CustomerAddress> $customerAddresses
 * @property Collection<CustomerTelephone> $customerTelephones
*/
class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'customer_id';

    protected $fillable = ['firstName', 'lastName', 'email', 'newsletter', 'status'];

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class, 'customer_group_id', 'customer_group_id');
    }

    public function customerAddresses()
    {
        return $this->hasMany(
            CustomerAddress::class,
            'customer_id',
            'customer_id'
        );
    }

    public function customerTelephones()
    {
        return $this->hasMany(
            CustomerTelephone::class,
            'customer_id',
            'customer_id'
        );
    }

    public function getFullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function customerDiscountCard()
    {
        return $this->hasMany(
            DiscountCard::class,
            'customer_id',
            'customer_id'
        );
    }

    public function companies()
    {
        return $this->belongsToMany(
            Company::class,
            'customers_to_companies',
            'customer_id',
            'company_id'
        );
    }
}
