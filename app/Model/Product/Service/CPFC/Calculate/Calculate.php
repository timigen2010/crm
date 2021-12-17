<?php

namespace App\Model\Product\Service\CPFC\Calculate;

use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductCPFC;
use App\Model\Product\Entity\ProductImage;
use App\Model\Product\Repository\ProductRepository;
use App\Model\Product\Service\CPFC\Factory\CPFCFactoryAbstract;
use App\Model\Product\Service\CPFC\Factory\Data;
use App\Model\Report\ProductComplect\Repository\ProductComplectRepository;
use App\Service\File\Delete\FileDeleteInterface;
use Exception;

class Calculate implements CalculateInterface
{
    private ProductComplectRepository $productComplectRepository;
    private CPFCFactoryAbstract $CPFCFactory;

    public function __construct(ProductComplectRepository $productComplectRepository, CPFCFactoryAbstract $CPFCFactory)
    {
        $this->productComplectRepository = $productComplectRepository;
        $this->CPFCFactory = $CPFCFactory;
    }

    /**
     * @param Product $product
     * @throws Exception
     */
    public function calculate(Product $product)
    {
        $originalProduct = $product;
        $productComplects =  $this->productComplectRepository->findByMaterial($product->product_id);
        $product = null;
        $material = null;
        foreach ($productComplects as $key=>$pc){
            if(!$material){
                $product = $pc->product_id;
                $material = $pc->material_id;
            }
            else{
                if($product == $pc->product_id && $material == $pc->material_id){
                    unset($productComplects[$key]);
                }
                else{
                    $product = $pc->product_id;
                    $material = $pc->material_id;
                }
            }
        }
        $products = [];
        foreach ($productComplects as $key=>$pc){
            $products[] = $pc->product_id;
        }



        $product = null;
        $productCPFC = (object)[
            'calories' => 0,
            'protein' => 0,
            'fat' => 0,
            'carbs' => 0,
        ];
        $material = null;

        $productComplectsByProduct = $this->productComplectRepository->findMaterialsByProducts($products);

        $productT = null;
        $materialT = null;
        foreach ($productComplectsByProduct as $key=>$pcbp){
            if(!$materialT){
                $productT = $pcbp->product_id;
                $materialT = $pcbp->material_id;
            }
            else{
                if($productT == $pcbp->product_id && $materialT == $pcbp->material_id){
                    unset($productComplectsByProduct[$key]);
                }
                else{
                    $productT = $pcbp->product_id;
                    $materialT = $pcbp->material_id;
                }
            }
        }

        $productsToReturn = [$originalProduct];
        foreach ($productComplectsByProduct as $pc){
            if($material && $material->product_id == $pc->material->product_id){
                continue;
            }
            else{
                $material = $pc->material;
            }

            if(!$product){
                $product = $pc->product;
                if($product->sale_able) {
                    $materialCPFC = $material->cpfc;
                    $productCPFC->calories += $materialCPFC->calories * $pc->amount;
                    $productCPFC->protein += $materialCPFC->protein * $pc->amount;
                    $productCPFC->fat += $materialCPFC->fat * $pc->amount;
                    $productCPFC->carbs += $materialCPFC->carbs * $pc->amount;
                }
            }
            else{
                if($product->sale_able){
                    if($product->product_id != $pc->product->product_id){
                        $this->CPFCFactory->create(new Data(
                            $product->product_id,
                            $productCPFC->calories,
                            $productCPFC->protein,
                            $productCPFC->fat,
                            $productCPFC->carbs,
                        ), $product->cpfc);
                        $productsToReturn[] = $product;
                        $product = $pc->product;
                        $productCPFC = (object)[
                            'calories' => 0,
                            'protein' => 0,
                            'fat' => 0,
                            'carbs' => 0,
                        ];
                    }
                    else{
                        $materialCPFC = $material->cpfc;
                        if($materialCPFC){
                            $productCPFC->calories += $materialCPFC->calories * $pc->amount;
                            $productCPFC->protein += $materialCPFC->protein * $pc->amount;
                            $productCPFC->fat += $materialCPFC->fat * $pc->amount;
                            $productCPFC->carbs += $materialCPFC->carbs * $pc->amount;
                        }
                    }
                }
            }
        }

        return $productsToReturn;

//
//
//        $this->fileDelete->delete($productImage->image);
//        $productImage->delete();
    }
}
