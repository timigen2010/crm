<?php

namespace App\Model\Language\Service\Factory;

use App\Model\Language\Entity\Language;

interface LanguageFactoryInterface
{
    public function create(Data $data, ?Language $language = null): Language;
}
