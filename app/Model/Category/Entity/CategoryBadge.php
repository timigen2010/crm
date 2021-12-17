<?php

namespace App\Model\Category\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $category_badge_id
 * @property string $code
 * @property string $image
 */
class CategoryBadge extends Model
{
    protected $table = 'category_badges';

    protected $primaryKey = 'category_badge_id';

    protected $fillable = ['code', 'image'];

    public $timestamps = false;
}
