<?php

namespace App\Model\Product\Service\Factory;

use App\Model\Product\Entity\Product;

class ProductFactory extends ProductFactoryAbstract
{
    protected function setData(Data $data, Product $product): Product
    {
        $product->product_type_id = $data->productTypeId;
        $product->currency_id = $data->currencyId;
        $product->unit_class_id = $data->unitClassId;
        $product->weight_class_id = $data->weightClassId;
        $product->main_category_id = $data->mainCategoryId;
        $product->name = $data->name;
        $product->cost_price = $data->costPrice;
        $product->price = $data->price;
        $product->weight = $data->weight;
        $product->minimum = $data->minimum;
        $product->status = $data->status;
        $product->sale_able = $data->saleAble;
        $product->cooking_time = $data->cookingTime;
        $product->date_available = $data->dateAvailable;
        $product->deleted = false;
        $product->descriptions()->delete();
        $product->menus()->detach();
        $product->categories()->detach();
        $product->save();
        foreach ($data->descriptions as $description) {
            $product->descriptions()->create([
                'product_id' => $product->product_id,
                'language_id' => $description['languageId'],
                'company_id' => $description['companyId'],
                'description' => $description['description'],
                'seo_description' => $description['seoDescription'],
                'meta_description' => $description['metaDescription'],
                'meta_title' => $description['metaTitle'],
                'meta_keywords' => $description['metaKeywords'],
            ]);
        }
        foreach ($data->categories as $category) {
            $product->categories()->attach($category);
        }
        foreach ($data->menus as $menu) {
            $product->menus()->attach($menu);
        }
        return $product;
    }
}
