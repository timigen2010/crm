<?php

namespace App\Model\Product\Service\Get\GetByMenu;

use App\Model\Category\Repository\CategoryRepository;
use App\Model\Product\Repository\ProductRepository;
use App\Model\Product\Service\Get\GetProductsInterface;

class GetProducts implements GetProductsInterface
{
    private ProductRepository $repository;
    private CategoryRepository $categoryRepository;

    public function __construct(ProductRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param int $menuId
     * @return mixed
     */
    public function getProducts($menuId)
    {
        $categories = $this->categoryRepository->findByMenuId($menuId);
        $categoriesFull = [];
        foreach ($categories as $category){
            $categoriesFull[$category->category_id] = $category;
        }
        $products = $this->repository->findByMenuId($menuId);
        foreach ($products as $index=>$product){
            $products[$index]['categories'] = $this->getProductCategories($categoriesFull, $product->categories);
        }

        return $products;
    }

    private function getProductCategories($categoriesAll, $productCategories){
        $categories = [];
        foreach ($productCategories as $category){
            $categories[] = $category->category_id;
            $workingCategory = $category;
            while ($workingCategory->parent_id !== 0){
                $workingCategory = $categoriesAll[$workingCategory->parent_id];
                $categories[] = $workingCategory->category_id;
            }
        }
        $categories = array_unique($categories);
        return $categories;
    }
}
