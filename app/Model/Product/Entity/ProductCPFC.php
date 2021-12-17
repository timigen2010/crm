<?php

namespace App\Model\Product\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_type_id
 * @property string $type_code
 */
class ProductCPFC extends Model
{
    protected $table = 'product_cpfc';

    protected $primaryKey = 'product_cpfc_id';

    protected $fillable = ['product_id', 'calories', 'protein', 'fat', 'carbs'];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
