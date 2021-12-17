<?php

namespace App\Model\Product\Entity;

use App\Model\Category\Entity\Category;
use App\Model\Menu\Entity\Menu;
use App\Model\Unit\Entity\UnitClass;
use App\Model\Weight\Entity\WeightClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $product_id
 * @property int $product_type_id
 * @property int $currency_id
 * @property int $unit_class_id
 * @property int $weight_class_id
 * @property int $main_category_id
 * @property string $name
 * @property float $cost_price
 * @property float $price
 * @property float $weight
 * @property float $minimum
 * @property bool $status
 * @property bool $sale_able
 * @property bool $deleted
 * @property int $cooking_time
 * @property Carbon $date_available
 * @property UnitClass $unitClass
 * @property ProductType $productType
 * @property Category $mainCategory
 * @property Collection<ProductDescription> $descriptions
 * @property Collection<ProductImage> $images
 * @property Collection<Menu> $menus
 * @property Collection<Category> $categories
 */
class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_id',
        'product_type_id',
        'currency_id',
        'unit_class_id',
        'weight_class_id',
        'main_category_id',
        'name',
        'cost_price',
        'price',
        'weight',
        'minimum',
        'status',
        'sale_able',
        'deleted',
        'cooking_time',
        'date_available',
    ];

    public function unitClass()
    {
        return $this->belongsTo(UnitClass::class, 'unit_class_id', 'unit_class_id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id', 'product_type_id');
    }

    public function mainCategory()
    {
        return $this->belongsTo(Category::class, 'main_category_id', 'category_id');
    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescription::class, 'product_id', 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'products_to_categories',
            'product_id',
            'category_id'
        );
    }

    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'products_to_menus',
            'product_id',
            'menu_id'
        );
    }

    public function complects()
    {
        return $this->hasMany(ProductComplect::class, 'product_id', 'product_id')->orderBy('date', 'desc');
    }

    public function cpfc()
    {
        return $this->belongsTo(ProductCPFC::class, 'product_id', 'product_id');
    }

    public function weightClass()
    {
        return $this->belongsTo(WeightClass::class, 'weight_class_id', 'weight_class_id');
    }
}
