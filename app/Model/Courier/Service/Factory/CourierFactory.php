<?php

namespace App\Model\Courier\Service\Factory;

use App\Model\Courier\Entity\Courier;
use App\Model\Courier\Service\Factory\CourierFactoryInterface;
use App\Model\Menu\Entity\Menu;

class CourierFactory implements CourierFactoryInterface
{

    public function create(Data $data, ?Courier $courier = null): Courier
    {
        $courier ??= new Courier();
        $courier->name = $data->name;
        $courier->telephone = $data->telephone;
        $courier->percent = $data->percent;
        $courier->deleted = $data->deleted;
        $courier->companies()->detach();
        $courier->save();
        foreach ($data->companies as $company) {
            $courier->companies()->attach($company);
        }
        return $courier;
    }
}
