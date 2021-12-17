<?php

namespace App\Model\Product\Service\Get\GetByCategories;

use App\Model\Product\Repository\ProductRepository;
use App\Model\Product\Service\Get\GetProductsInterface;

class GetProductsByCategories implements GetProductsByCategoriesInterface
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $categories
     * @return mixed
     */
    public function getProducts($categoriesIds)
    {
        $products = $this->repository->findByCategories($categoriesIds);

        foreach ($products as $index=>$product){
            foreach ($product->categories as $cindex=>$category){
                $products[$index]->categories[$cindex] = $category->category_id;
            }
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
