<?php

namespace App\Model\Menu\Service\Delete;

use App\Model\Menu\Entity\Menu;

interface MenuDeleteInterface
{
    public function delete(Menu $menu);
}
