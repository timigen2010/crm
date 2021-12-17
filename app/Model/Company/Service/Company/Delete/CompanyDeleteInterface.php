<?php

namespace App\Model\Company\Service\Company\Delete;

use App\Model\Company\Entity\Company;

interface CompanyDeleteInterface
{
    public function delete(Company $company);
}
