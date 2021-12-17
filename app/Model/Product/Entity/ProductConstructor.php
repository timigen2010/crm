<?php

namespace App\Model\Product\Entity;

use App\Model\Category\Entity\Category;
use App\Model\Company\Entity\Company;
use App\Model\Unit\Entity\UnitClass;
use App\Model\Weight\Entity\WeightClass;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_constructor_id
 * @property string $type_code
 */
class ProductConstructor extends Model
{
    protected $table = 'product_constructors';

    protected $primaryKey = 'product_constructor_id';

    protected $fillable = ['main_product_id', 'basis_category_id', 'sauce_category_id', 'status', 'deleted'];

    public $timestamps = true;

    public function mainProduct()
    {
        return $this->belongsTo(Product::class, 'main_product_id', 'product_id');

    }

    public function basis()
    {
        return $this->belongsTo(Category::class, 'basis_category_id', 'category_id');

    }

    public function sauce()
    {
        return $this->belongsTo(Category::class, 'sauce_category_id', 'category_id');

    }

    public function toppings()
    {
        return $this->belongsToMany(
            Category::class,
            'product_constructors_to_toppings',
            'product_constructor_id',
            'topping_category_id'
        );
    }

    public function companies()
    {
        return $this->belongsToMany(
            Company::class,
            'product_constructors_to_companies',
            'company_id',
            'company_id'
        );
    }

}
