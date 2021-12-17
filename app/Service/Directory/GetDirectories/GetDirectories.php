<?php

namespace App\Service\Directory\GetDirectories;

use App\Model\Category\Repository\CategoryBadgeRepository;
use App\Model\Category\Repository\CategoryRepository;
use App\Model\Company\Repository\CompanyRepository;
use App\Model\Currency\Repository\CurrencyRepository;
use App\Model\Language\Repository\LanguageRepository;
use App\Model\Menu\Repository\MenuRepository;
use App\Model\Product\Repository\ProductTypeRepository;
use App\Model\Unit\Repository\UnitClassRepository;
use App\Model\Weight\Repository\WeightClassRepository;

class GetDirectories implements GetDirectoriesInterface
{
    private LanguageRepository $languageRepository;
    private CategoryBadgeRepository $categoryBadgeRepository;
    private CategoryRepository $categoryRepository;
    private CompanyRepository $companyRepository;
    private MenuRepository $menuRepository;
    private CurrencyRepository $currencyRepository;
    private UnitClassRepository $unitClassRepository;
    private WeightClassRepository $weightClassRepository;
    private ProductTypeRepository $productTypeRepository;

    public function __construct(LanguageRepository $languageRepository,
                                CategoryBadgeRepository $categoryBadgeRepository,
                                CategoryRepository $categoryRepository,
                                CompanyRepository $companyRepository,
                                MenuRepository $menuRepository,
                                CurrencyRepository $currencyRepository,
                                UnitClassRepository $unitClassRepository,
                                WeightClassRepository $weightClassRepository,
                                ProductTypeRepository $productTypeRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->categoryBadgeRepository = $categoryBadgeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->companyRepository = $companyRepository;
        $this->menuRepository = $menuRepository;
        $this->currencyRepository = $currencyRepository;
        $this->unitClassRepository = $unitClassRepository;
        $this->weightClassRepository = $weightClassRepository;
        $this->productTypeRepository = $productTypeRepository;
    }

    /**
     * @param Data $data
     * @return array
     */
    public function get($data)
    {
        $directories = [];
        if ($data->isLanguages) {
            $directories["languages"] = $this->languageRepository->getSimpleInfo();
        }
        if ($data->isCategoryBadges) {
            $directories["categoryBadges"] = $this->categoryBadgeRepository->getSimpleInfo();
        }
        if ($data->isCategories) {
            $directories["categories"] = $this->categoryRepository->getSimpleInfo();
        }
        if ($data->isCompanies) {
            $directories["companies"] = $this->companyRepository->getSimpleInfo();
        }
        if ($data->isMenus) {
            $directories["menus"] = $this->menuRepository->getSimpleInfoAuthorized();
        }
        if ($data->isCurrencies) {
            $directories["currencies"] = $this->currencyRepository->getSimpleInfo();
        }
        if ($data->isUnitClasses) {
            $directories["unitClasses"] = $this->unitClassRepository->getSimpleInfo();
        }
        if ($data->isWeightClasses) {
            $directories["weightClasses"] = $this->weightClassRepository->getSimpleInfo();
        }
        if ($data->isProductTypes) {
            $directories["productTypes"] = $this->productTypeRepository->getSimpleInfo();
        }
        return $directories;
    }
}
