<?php

namespace App\Model\Language\Service\Factory;

use App\Model\Language\Entity\Language;

class LanguageFactory implements LanguageFactoryInterface
{
    public function create(Data $data, ?Language $language = null): Language
    {
        $language = $language ?? new Language();
        $language->deleted = false;
        $language->name = $data->name;
        $language->code = $data->code;
        $language->locale = $data->locale;
        $language->status = $data->status;
        $language->image = $data->image;
        $language->save();
        return $language;
    }
}
