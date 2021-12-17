<?php

namespace App\Model\Courier\Service\Get\ByCompany;

interface GetCouriersByCompanyInterface
{
    public function get(int $companyId);
}
