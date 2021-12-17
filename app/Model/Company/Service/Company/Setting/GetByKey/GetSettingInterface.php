<?php

namespace App\Model\Company\Service\Company\Setting\GetByKey;

interface GetSettingInterface
{
    /**
     * @param int $companyId
     * @param string $key
     * @return mixed
     */
    public function get(int $companyId, string $key);
}
