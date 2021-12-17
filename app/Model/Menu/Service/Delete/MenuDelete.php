<?php

namespace App\Model\Menu\Service\Delete;

use App\Model\Menu\Entity\Menu;
use Exception;

class MenuDelete implements MenuDeleteInterface
{

    /**
     * @param Menu $menu
     * @throws Exception
     */
    public function delete(Menu $menu)
    {
        $menu->companies()->detach();
        $menu->categories()->detach();
        $menu->products()->detach();
        $menu->delete();
    }
}
