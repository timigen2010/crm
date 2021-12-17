<?php

namespace App\Model\Category\Service\Factory;

class Data
{
    public array $descriptions;

    public int $categoryBadgeId;

    public bool $status;

    public array $menus;

    public ?int $parentId;

    public function __construct(array $descriptions,
                                int $categoryBadgeId,
                                bool $status,
                                array $menus,
                                ?int $parentId)
    {
        $this->descriptions = $descriptions;
        $this->categoryBadgeId = $categoryBadgeId;
        $this->status = $status;
        $this->menus = $menus;
        $this->parentId = $parentId;
    }
}
