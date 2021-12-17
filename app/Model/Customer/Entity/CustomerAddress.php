<?php

namespace App\Model\Customer\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $customer_address_id
 * @property int $customer_id
 * @property int $city_id
 * @property string $address_1
 * @property string $address_2
 * @property bool $is_main
 */
class CustomerAddress extends Model
{
    protected $table = 'customer_addresses';

    protected $primaryKey = 'customer_address_id';

    protected $fillable = ['customer_id', 'city_id', 'address_1', 'address_2', 'is_main'];

    public $timestamps = false;
}
