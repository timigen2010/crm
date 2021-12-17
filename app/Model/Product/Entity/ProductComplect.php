<?php

namespace App\Model\Product\Entity;

use App\Model\Unit\Entity\UnitClass;
use App\Model\Weight\Entity\WeightClass;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_type_id
 * @property string $type_code
 */
class ProductComplect extends Model
{
    protected $table = 'product_complects';

    protected $primaryKey = 'product_complect_id';

    protected $fillable = ['product_id', 'material_id', 'date', 'price', 'currency_id', 'amount', 'unit_class_id'];

    public $timestamps = false;

    public function material()
    {
        return $this->belongsTo(Product::class, 'material_id', 'product_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function unitClass()
    {
        return $this->belongsTo(UnitClass::class, 'unit_class_id', 'unit_class_id');
    }
}
