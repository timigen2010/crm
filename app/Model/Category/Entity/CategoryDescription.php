<?php

namespace App\Model\Category\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $category_description_id
 * @property int $category_id
 * @property int $language_id
 * @property int $company_id
 * @property string $name
 * @property string $description
 * @property string $h1_title
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $short_description
 */
class CategoryDescription extends Model
{
    protected $table = 'category_descriptions';

    protected $primaryKey = 'category_description_id';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'language_id',
        'company_id',
        'h1_title',
        'meta_title',
        'short_description',
        'meta_description',
        'meta_keywords'
    ];

    public $timestamps = false;
}
