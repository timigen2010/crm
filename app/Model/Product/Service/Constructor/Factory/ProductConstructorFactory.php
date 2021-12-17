<?php

namespace App\Model\Product\Service\Constructor\Factory;

use App\Model\Product\Entity\ProductConstructor;
use App\Model\Product\Service\Constructor\Factory\ProductConstructorFactoryAbstract;

class ProductConstructorFactory extends ProductConstructorFactoryAbstract
{
    protected function setData(Data $data, ProductConstructor $productConstructor): ProductConstructor
    {
        $productConstructor->main_product_id = $data->mainProductId;
        $productConstructor->basis_category_id = $data->basisCategoryId;
        $productConstructor->sauce_category_id = $data->sauceCategoryId;
        $productConstructor->status = $data->status;
        $productConstructor->deleted = $data->deleted;
        $productConstructor->toppings()->delete();
        $productConstructor->companies()->detach();
        $productConstructor->save();
        foreach ($data->toppingsIds as $topping) {
            $productConstructor->toppings()->create([
                'product_constructor_id' => $productConstructor->product_constructor_id,
                'topping_category_id' => $topping
            ]);
        }
        foreach ($data->companies as $company) {
            $productConstructor->companies()->attach($company);
        }
        return $productConstructor;
    }
}
