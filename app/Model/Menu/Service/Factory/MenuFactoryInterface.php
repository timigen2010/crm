<?php

namespace App\Model\Menu\Service\Factory;

use App\Model\Menu\Entity\Menu;

interface MenuFactoryInterface
{
    public function create(Data $data, ?Menu $menu = null): Menu;
}
