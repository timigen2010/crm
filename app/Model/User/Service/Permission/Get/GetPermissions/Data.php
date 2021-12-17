<?php

namespace App\Model\User\Service\Permission\Get\GetPermissions;

class Data
{
    public int $page;

    public int $limit;

    public function __construct(int $page, int $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }
}
