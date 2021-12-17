<?php

namespace App\Model\Courier\Service\Delete;

use App\Model\Courier\Entity\Courier;

interface CourierDeleteInterface
{
    public function delete(Courier $menu);
}
