<?php

namespace App\Model\Product\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_description_id
 * @property int $product_id
 * @property int $language_id
 * @property int $company_id
 * @property string $description
 * @property string $seo_description
 * @property string $meta_description
 * @property string $meta_title
 * @property string $meta_keywords
 */
class ProductDescription extends Model
{
    protected $table = 'product_descriptions';

    protected $primaryKey = 'product_description_id';

    protected $fillable = [
        'product_id',
        'language_id',
        'company_id',
        'description',
        'seo_description',
        'meta_description',
        'meta_title',
        'meta_keywords',
    ];

    public $timestamps = false;
}
