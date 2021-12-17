<?php

namespace App\Model\Category\Service\Factory;

use App\Model\Category\Entity\Category;
use App\Model\Category\Repository\CategoryBadgeRepository;
use App\Model\Category\Repository\CategoryRepository;

class CategoryFactory extends CategoryFactoryAbstract
{
    private CategoryRepository $categoryRepository;

    private CategoryBadgeRepository $categoryBadgeRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                CategoryBadgeRepository $categoryBadgeRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryBadgeRepository = $categoryBadgeRepository;
    }

    protected function setData(Data $data, Category $category): Category
    {
        $categoryBadge = $data->categoryBadgeId ? $this->categoryBadgeRepository->find($data->categoryBadgeId) : null;
        $parent = $data->parentId ? $this->categoryRepository->find($data->parentId) : null;
        if ($data->categoryBadgeId && !$categoryBadge) {
            throw new \DomainException('Category badge not found');
        }
        if ($data->parentId && !$parent) {
            throw new \DomainException('Parent category not found');
        }
        $category->status = $data->status;
        $category->categoryBadge()->associate($categoryBadge);
        $category->parent()->associate($parent);
        $category->descriptions()->delete();
        $category->menus()->detach();
        $category->save();
        foreach ($data->descriptions as $description) {
            $category->descriptions()->create([
                'category_id' => $category->category_id,
                'name' => $description['name'],
                'description' => $description['description'],
                'language_id' => $description['languageId'],
                'company_id' => $description['companyId'],
                'h1_title' => $description['h1Title'],
                'meta_title' => $description['metaTitle'],
                'short_description' => $description['shortDescription'],
                'meta_description' => $description['metaDescription'],
                'meta_keywords' => $description['metaKeywords']
            ]);
        }
        foreach ($data->menus as $menu) {
            $category->menus()->attach($menu);
        }
        return $category;
    }
}
