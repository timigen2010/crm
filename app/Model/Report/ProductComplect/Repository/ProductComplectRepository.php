<?php

namespace App\Model\Report\ProductComplect\Repository;

use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductComplect;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class ProductComplectRepository
{
    private Product $model;
    private ProductComplect $PCModel;

    public function __construct(Product $model, ProductComplect $PCModel)
    {
        $this->model = $model;
        $this->PCModel = $PCModel;
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = $this->model->query();
        $query->where('deleted', '=', 0);
        $query->where('status', '=', 1);
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        $query->limit(50);
        return $query->get();
    }



    public function lastComplects(array $where, ?array $orderBy = []){


        $query = $this->model->query();
        if (!is_null($where['name'])) {
            $query->where('name', 'like', '%'.$where['name'].'%');
        }

        if (!is_null($where['saleAble'])) {
            $query->where('sale_able', '=', $where['saleAble']);
        }
        $query->where('deleted', '=', 0);
        $query->where('status', '=', 1);
        $query->limit(50);
        $products = $query->with('complects')->get();

        $maxDate = [];
        foreach ($products as $key=>$product){
            if(!empty($products[$key]->complects)){
                $maxDate[$key] = false;
                foreach ($products[$key]->complects as $ckey=>$complect){
                    if(!$maxDate || strtotime($complect->date) > strtotime($maxDate[$key])){
                        $maxDate[$key] = $complect->date;
                    }
                }
            }
        }


        foreach ($products as $key=>$product){
            $lastComplects = $products[$key]->complects;
            if(!empty($products[$key]->complects)){
                foreach ($products[$key]->complects as $ckey=>$complect){
                    if(strtotime($complect->date) != strtotime($maxDate[$key])){
                        unset($lastComplects[$ckey]);
                    }
                }
            }
        }

        return $products;
    }

    public function findByMaterial(int $materialId){
        $query = $this->PCModel->query()->with('material')->with('product');
        $query->where('material_id', '=', $materialId);
        $query->orderBy('product_id', 'asc');
        $query->orderBy('material_id', 'asc');
        $query->orderBy('date', 'desc');

        return $query->get();
    }

    public function findMaterialsByProduct($productId){

        $query = $this->PCModel->query();
        $query->where('product_id', '=', $productId);
        $query->orderBy('product_id', 'asc');
        $query->orderBy('material_id', 'asc');
        $query->orderBy('date', 'desc');

        return $query->get();
    }

    public function findMaterialsByProducts($productIds){

        $query = $this->PCModel->query()->with('material.cpfc')->with('product.cpfc');
        $query->whereIn('product_id', $productIds);
        $query->orderBy('product_id', 'asc');
        $query->orderBy('material_id', 'asc');
        $query->orderBy('date', 'desc');

        return $query->get();
    }
}
