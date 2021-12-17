<?php

namespace App\Model\Language\Service\Delete;

use App\Model\Language\Entity\Language;

class LanguageDelete implements LanguageDeleteInterface
{

    public function delete(Language $language)
    {
        $language->deleted = true;
        $language->save();
    }
}
