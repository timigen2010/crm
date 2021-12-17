<?php

namespace App\Service\Product\CreateUpdate;

use App\Model\Product\Entity\Product;
use App\Model\Product\Service\Factory\Data;

interface CreateUpdateInterface
{
    public function handle(Data $data, ?Product $product = null): Product;
}
