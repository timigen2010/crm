<?php

namespace App\Model\Customer\Entity\Group;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $customer_group_description_id
 * @property int $customer_group_id
 * @property string $name
 * @property string $description
 * @property int $language_id
 */
class CustomerGroupDescription extends Model
{
    protected $table = 'customer_group_descriptions';

    protected $primaryKey = 'customer_group_description_id';

    protected $fillable = ['customer_group_id', 'name', 'description', 'language_id'];

    public $timestamps = false;
}
