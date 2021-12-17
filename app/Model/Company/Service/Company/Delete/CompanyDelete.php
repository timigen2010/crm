<?php

namespace App\Model\Company\Service\Company\Delete;

use App\Model\Company\Entity\Company;
use Exception;

class CompanyDelete implements CompanyDeleteInterface
{

    /**
     * @param Company $company
     * @throws Exception
     */
    public function delete(Company $company)
    {
        $company->settings()->delete();
        $company->descriptions()->delete();
        $company->delete();
    }
}
