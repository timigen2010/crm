<?php

namespace App\Model\Customer\Entity\Group;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $customer_group_id
 * @property int $company_id
 * @property Collection<CustomerGroupDescription> $customerGroupDescriptions
 */
class CustomerGroup extends Model
{
    protected $table = 'customer_groups';

    protected $primaryKey = 'customer_group_id';

    protected $fillable = ['company_id'];

    public $timestamps = false;

    public function customerGroupDescriptions()
    {
        return $this->hasMany(
            CustomerGroupDescription::class,
            'customer_group_id',
            'customer_group_id'
        );
    }
}
