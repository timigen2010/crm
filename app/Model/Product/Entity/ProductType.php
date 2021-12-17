<?php

namespace App\Model\Product\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_type_id
 * @property string $type_code
 */
class ProductType extends Model
{
    protected $table = 'product_types';

    protected $primaryKey = 'product_type_id';

    protected $fillable = ['type_code'];

    public $timestamps = false;
}
