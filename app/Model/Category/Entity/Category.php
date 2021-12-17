<?php

namespace App\Model\Category\Entity;

use App\Model\Menu\Entity\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $category_id
 * @property int $category_badge_id
 * @property bool $status
 * @property CategoryBadge $categoryBadge
 * @property Category $parent
 * @property Collection<CategoryImage> $images
 * @property Collection<CategoryDescription> $descriptions
 * @property Collection<Menu> $menus
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'category_id';

    protected $fillable = ['category_badge_id', 'status'];

    public $timestamps = true;

    public function categoryBadge()
    {
        return $this->belongsTo(CategoryBadge::class, 'category_badge_id', 'category_badge_id');
    }

    public function images()
    {
        return $this->hasMany(CategoryImage::class, 'category_id', 'category_id');
    }

    public function descriptions()
    {
        return $this->hasMany(CategoryDescription::class, 'category_id', 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(
            Category::class,
            'parent_id',
            'category_id'
        );
    }

    public function menus()
    {
        return $this->belongsToMany(
            Menu::class,
            'categories_to_menus',
            'category_id',
            'menu_id'
        );
    }

    public function getDescription(?int $languageId = null): ?CategoryDescription
    {
        /** @var CategoryDescription $description */
        if (is_null($languageId)) {
            $description = $this->descriptions->first();
        } else {
            $description = $this->descriptions->find(
                fn(CategoryDescription $description) => $description->language_id === $languageId
            );
        }
        return $description;
    }

    public function getName(?int $languageId = null): ?string
    {
        $description = $this->getDescription($languageId);
        return $description ? $description->name : null;
    }
}
