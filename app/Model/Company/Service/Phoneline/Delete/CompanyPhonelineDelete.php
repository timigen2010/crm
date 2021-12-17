<?php

namespace App\Model\Company\Service\Phoneline\Delete;

use App\Model\Company\Entity\Phoneline\CompanyPhoneline;

class CompanyPhonelineDelete implements CompanyPhonelineDeleteInterface
{

    /**
     * @param CompanyPhoneline $companyPhoneline
     * @throws \Exception
     */
    public function delete(CompanyPhoneline $companyPhoneline)
    {
        $companyPhoneline->descriptions()->delete();
        $companyPhoneline->delete();
    }
}
