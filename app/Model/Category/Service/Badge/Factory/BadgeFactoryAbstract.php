<?php

namespace App\Model\Category\Service\Badge\Factory;

use App\Model\Category\Entity\CategoryBadge;
use Illuminate\Support\Facades\DB;

abstract class BadgeFactoryAbstract
{
    abstract protected function setData(Data $data, CategoryBadge $badge): CategoryBadge;

    public function create(Data $data, ?CategoryBadge $badge = null): CategoryBadge
    {
        return DB::transaction(function () use($data, $badge) {
            $badge = $badge ?? CategoryBadge::query()->make();
            return $this->setData($data, $badge);
        });
    }
}
