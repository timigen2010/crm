<?php

namespace App\Model\Menu\Entity;

use App\Model\Category\Entity\Category;
use App\Model\Company\Entity\Company;
use App\Model\Product\Entity\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $menu_id
 * @property string $name
 * @property Collection<Company> $companies
 * @property Collection<Category> $categories
 * @property Collection<Product> $products
 */
class Menu extends Model
{
    protected $table = 'menus';

    protected $primaryKey = 'menu_id';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function companies()
    {
        return $this->belongsToMany(
            Company::class,
            'menus_to_companies',
            'menu_id',
            'company_id'
        );
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'categories_to_menus',
            'menu_id',
            'category_id'
        );
    }

    public function products()
    {
        return $this->belongsToMany(
            Menu::class,
            'products_to_menus',
            'menu_id',
            'product_id'
        );
    }
}
