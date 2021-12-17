<?php

namespace App\Model\Category\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $category_image_id
 * @property int $category_id
 * @property string $image
 * @property int $image_type
 */
class CategoryImage extends Model
{
    protected $table = 'category_images';

    protected $primaryKey = 'category_image_id';

    protected $fillable = ['category_id', 'image', 'image_type'];

    public $timestamps = false;
}
