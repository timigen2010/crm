<?php

namespace App\Model\Product\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_image_id
 * @property int $product_id
 * @property string $image
 */
class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $primaryKey = 'product_image_id';

    protected $fillable = ['product_id', 'image'];

    public $timestamps = false;
}
