<?php

namespace App\Model\Company\Service\Phoneline\Delete;

use App\Model\Company\Entity\Phoneline\CompanyPhoneline;

interface CompanyPhonelineDeleteInterface
{
    public function delete(CompanyPhoneline $companyPhoneline);
}
