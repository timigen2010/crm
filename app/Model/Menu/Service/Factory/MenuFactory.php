<?php

namespace App\Model\Menu\Service\Factory;

use App\Model\Menu\Entity\Menu;

class MenuFactory implements MenuFactoryInterface
{

    public function create(Data $data, ?Menu $menu = null): Menu
    {
        $menu ??= new Menu();
        $menu->name = $data->name;
        $menu->companies()->detach();
        $menu->save();
        foreach ($data->companies as $company) {
            $menu->companies()->attach($company);
        }
        return $menu;
    }
}
