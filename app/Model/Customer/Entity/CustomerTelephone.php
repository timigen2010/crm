<?php

namespace App\Model\Customer\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $customer_telephone_id
 * @property int $customer_id
 * @property string $telephone
 * @property bool $is_main
 */
class CustomerTelephone extends Model
{
    protected $table = 'customer_telephones';

    protected $primaryKey = 'customer_telephone_id';

    protected $fillable = ['customer_id', 'telephone', 'is_main'];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
}
