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
use App\Model\Product\Service\CPFC\GetByProductIds\GetCPFCByProductIds;
use App\Model\Product\Service\CPFC\GetByProductIds\GetCPFCByProductIdsInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductCPFCController extends Controller
{
    private EditCPFC $editCPFC;
    private GetCPFCByProductIdsInterface $getCPFCByProductIds;

    public function __construct(EditCPFC $editCPFC, GetCPFCByProductIdsInterface $getCPFCByProductIds)
    {
        $this->editCPFC = $editCPFC;
        $this->getCPFCByProductIds = $getCPFCByProductIds;
    }

    public function getAction(Product $product)
    {
        return new ProductCPFCResource($product->cpfc);
    }

    public function getByIdsAction(GetProductsCPFCRequest $request)
    {
        return ProductsCPFCResource::collection(
            $this->getCPFCByProductIds->get((array)$request->request->get('productIds'))
        );
    }

    public function editAction(Product $product, ProductCPFCRequest $request)
    {
        return $this->editCPFC->edit($product, new Data(
            $product->product_id,
            $request->request->get('calories'),
            $request->request->get('protein'),
            $request->request->get('fat'),
            $request->request->get('carbs'),
        ));
    }

    
}
