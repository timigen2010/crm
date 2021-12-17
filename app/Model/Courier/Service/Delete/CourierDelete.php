<?php

namespace App\Model\Courier\Service\Delete;

use App\Model\Courier\Entity\Courier;
use App\Model\Courier\Service\Delete\CourierDeleteInterface;
use Exception;

class CourierDelete implements CourierDeleteInterface
{

    /**
     * @param Courier $courier
     * @throws Exception
     */
    public function delete(Courier $courier)
    {
        $courier->companies()->detach();
        $courier->delete();
    }
}
