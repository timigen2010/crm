<?php

namespace App\Model\Discount\Service\CardOperation\GetOperations;

class Data
{
    public int $page;
    public int $limit;
    public ?string $type;

    public function __construct(?int $page, ?int $limit, string $type = null)
    {
        $this->page = $page ?? 1;
        $this->limit = $limit ?? 10;
        $this->type = $type;
    }
}
