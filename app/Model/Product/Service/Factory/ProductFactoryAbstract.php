<?php

namespace App\Model\Product\Service\Factory;

use App\Model\Product\Entity\Product;
use Illuminate\Support\Facades\DB;

abstract class ProductFactoryAbstract
{
    abstract protected function setData(Data $data, Product $product): Product;

    public function create(Data $data, ?Product $product = null): Product
    {
        return DB::transaction(function () use($data, $product) {
            $product = $product ?? Product::query()->make();
            return $this->setData($data, $product);
        });
    }
}
