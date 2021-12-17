<?php

namespace App\Model\Language\Service\Delete;

use App\Model\Language\Entity\Language;

interface LanguageDeleteInterface
{
    public function delete(Language $language);
}
