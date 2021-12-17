<?php

namespace App\Model\Product\Service\CPFC\Factory;

use App\Model\Product\Entity\ProductCPFC;
use Illuminate\Support\Facades\DB;

abstract class CPFCFactoryAbstract
{
    abstract protected function setData(Data $data, ProductCPFC $productCPFC): ProductCPFC;

    public function create(Data $data, ?ProductCPFC $productCPFC = null): ProductCPFC
    {
        return DB::transaction(function () use($data, $productCPFC) {
            $productCPFC = $productCPFC ?? ProductCPFC::query()->make();
            return $this->setData($data, $productCPFC);
        });
    }
}
