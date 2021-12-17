<?php

namespace App\Model\Category\Service\Badge\Factory;

use App\Model\Category\Entity\CategoryBadge;

class BadgeFactory extends BadgeFactoryAbstract
{

    protected function setData(Data $data, CategoryBadge $badge): CategoryBadge
    {
        $badge->code = $data->code;
        $badge->image = $data->image;
        $badge->save();
        return $badge;
    }
}
