<?php

namespace App\Model\Product\Service\Constructor\Factory;

use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductConstructor;
use Illuminate\Support\Facades\DB;

abstract class ProductConstructorFactoryAbstract
{
    abstract protected function setData(Data $data, ProductConstructor $productConstructor): ProductConstructor;

    public function create(Data $data, ?ProductConstructor $productConstructor = null): ProductConstructor
    {
        return DB::transaction(function () use($data, $productConstructor) {
            $productConstructor = $productConstructor ?? ProductConstructor::query()->make();
            return $this->setData($data, $productConstructor);
        });
    }
}
