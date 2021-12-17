<?php

namespace App\Model\Category\Service\Badge\Factory;

class Data
{
    public string $code;

    public string $image;

    public function __construct(string $code, string $image)
    {
        $this->code = $code;
        $this->image = $image;
    }


}
