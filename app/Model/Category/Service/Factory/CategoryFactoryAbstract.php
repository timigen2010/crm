<?php

namespace App\Model\Category\Service\Factory;

use App\Model\Category\Entity\Category;
use Illuminate\Support\Facades\DB;

abstract class CategoryFactoryAbstract
{
    abstract protected function setData(Data $data, Category $category): Category;

    public function create(Data $data, ?Category $category = null): Category
    {
        return DB::transaction(function () use($data, $category) {
            $category = $category ?? Category::query()->make();
            return $this->setData($data, $category);
        });
    }
}
