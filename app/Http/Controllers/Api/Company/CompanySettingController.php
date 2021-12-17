<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Resources\Company\CompanySettingResource;
use App\Model\Company\Entity\Company;
use App\Model\Company\Service\Company\Setting\GetByKey\GetSettingInterface as GetSettingByKeyInterface;
use Swagger\Annotations as SWG;

class CompanySettingController
{
    private GetSettingByKeyInterface $getSettingByKey;

    public function __construct(GetSettingByKeyInterface $getSettingByKey)
    {
        $this->getSettingByKey = $getSettingByKey;
    }

    /**
     * @SWG\Get(
     *     path="api/companies/{company_id}/settings/{key}",
     *     tags={"Companies"},
     *     @SWG\Parameter(name="key", in="query", required=true, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Show language id by company id",
     *         @SWG\Schema(ref="#/definitions/CompanySettingResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Company $company
     * @param string $key
     * @return CompanySettingResource
     */
    public function getSettingByKeyAction(Company $company, string $key)
    {
        return new CompanySettingResource($this->getSettingByKey->get($company->company_id, $key));
    }
}
