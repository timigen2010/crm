<?php

namespace App\Model\Report\ProductComplect\Service\Get;

use App\Model\Report\ProductComplect\Service\Get\GetProductComplectsByParams\Data;

interface GetProductComplectsInterface
{
    public function getProductComplects(?Data $data);

}
