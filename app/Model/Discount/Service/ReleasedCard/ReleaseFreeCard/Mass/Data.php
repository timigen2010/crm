<?php

namespace App\Model\Discount\Service\ReleasedCard\ReleaseFreeCard\Mass;

class Data
{
    public int $start;
    public int $end;

    public function __construct(int $start, int $end)
    {
        $this->start = $start;
        $this->end = $end;
    }


}
