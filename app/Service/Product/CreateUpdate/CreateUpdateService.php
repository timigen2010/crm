<?php

namespace App\Service\Product\CreateUpdate;

use App\Model\Menu\Repository\MenuRepository;
use App\Model\Product\Entity\Product;
use App\Model\Product\Service\Factory\Data;
use App\Model\Product\Service\Factory\ProductFactoryAbstract;
use DomainException;

class CreateUpdateService implements CreateUpdateInterface
{
    private ProductFactoryAbstract $factory;

    private MenuRepository $menuRepository;

    public function __construct(ProductFactoryAbstract $factory, MenuRepository $menuRepository)
    {
        $this->factory = $factory;
        $this->menuRepository = $menuRepository;
    }

    public function handle(Data $data, ?Product $product = null): Product
    {
        $availableMenus = array_unique($this->menuRepository->getMenuIdsByCategoryIds($data->categories));
        foreach ($data->menus as $menuId) {
            if (!in_array($menuId, $availableMenus)) {
                throw new DomainException("Menu with id {$menuId} does not available");
            }
        }
        return $this->factory->create($data, $product);
    }
}
