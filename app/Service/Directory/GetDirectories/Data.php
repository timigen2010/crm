<?php

namespace App\Service\Directory\GetDirectories;

class Data
{
    public bool $isLanguages;
    public bool $isCategoryBadges;
    public bool $isCategories;
    public bool $isCompanies;
    public bool $isMenus;
    public bool $isCurrencies;
    public bool $isUnitClasses;
    public bool $isWeightClasses;
    public bool $isProductTypes;

    public function __construct(bool $isLanguages,
                                bool $isCategoryBadges,
                                bool $isCategories,
                                bool $isCompanies,
                                bool $isMenus,
                                bool $isCurrencies,
                                bool $isUnitClasses,
                                bool $isWeightClasses,
                                bool $isProductTypes)
    {
        $this->isLanguages = $isLanguages;
        $this->isCategoryBadges = $isCategoryBadges;
        $this->isCategories = $isCategories;
        $this->isCompanies = $isCompanies;
        $this->isMenus = $isMenus;
        $this->isCurrencies = $isCurrencies;
        $this->isUnitClasses = $isUnitClasses;
        $this->isWeightClasses = $isWeightClasses;
        $this->isProductTypes = $isProductTypes;
    }


}
