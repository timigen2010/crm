<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Requests\Product\GetProductsCPFCRequest;
use App\Http\Requests\Product\ProductCPFCRequest;
use App\Http\Resources\Product\ProductCPFCResource;
use App\Http\Resources\Product\ProductsCPFCResource;
use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductCPFC;
use App\Model\Product\Service\CPFC\Edit\EditCPFC;
use App\Model\Product\Service\CPFC\Factory\CPFCFactoryAbstract;
use App\Model\Product\Service\CPFC\Factory\Data;
use App\Model\Product\Service\CPFC\GetByProductId\GetCPFCByProductIdInterface;
use App\Model\Product\Service\CPFC\GetByProductIds\GetCPFCByProductIds;
use App\Model\Product\Service\CPFC\GetByProductIds\GetCPFCByProductIdsInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ForeignProductCPFCController extends Controller
{
    private GetCPFCByProductIdsInterface $getCPFCByProductIds;
    private GetCPFCByProductIdInterface $getCPFCByProductId;

    public function __construct(GetCPFCByProductIdInterface $getCPFCByProductId, GetCPFCByProductIdsInterface $getCPFCByProductIds)
    {
        $this->getCPFCByProductId = $getCPFCByProductId;
        $this->getCPFCByProductIds = $getCPFCByProductIds;
    }

    public function getAction(int $productId)
    {
        return ProductsCPFCResource::collection(
            $this->getCPFCByProductId->get($productId)
        );
    }

    public function getByIdsAction(GetProductsCPFCRequest $request)
    {
        return ProductsCPFCResource::collection(
            $this->getCPFCByProductIds->get((array)$request->request->get('productIds'))
        );
    }

}
