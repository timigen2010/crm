<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Requests\Company\CompanyRequest;
use App\Http\Resources\Company\CompaniesResource;
use App\Http\Resources\Company\CompanyResource;
use App\Model\Company\Entity\Company;
use App\Model\Company\Service\Company\Delete\CompanyDeleteInterface;
use App\Model\Company\Service\Company\Factory\CompanyFactoryAbstract;
use App\Model\Company\Service\Company\Factory\Data as CompanyFactoryData;
use App\Model\Company\Service\Company\Get\GetCompaniesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Swagger\Annotations as SWG;

class CompanyController
{
    private CompanyFactoryAbstract $companyFactory;

    private CompanyDeleteInterface $companyDelete;

    private GetCompaniesInterface $getCompanies;

    public function __construct(CompanyFactoryAbstract $companyFactory,
                                CompanyDeleteInterface $companyDelete,
                                GetCompaniesInterface $getCompanies)
    {
        $this->companyFactory = $companyFactory;
        $this->companyDelete = $companyDelete;
        $this->getCompanies = $getCompanies;
    }

    /**
     * @SWG\Post(
     *     path="api/companies/new",
     *     tags={"Companies"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CompanyRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create company",
     *         @SWG\Schema(ref="#/definitions/CompanyResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CompanyRequest $request
     * @return CompanyResource
     */
    public function createAction(CompanyRequest $request)
    {
        $company = $this->companyFactory->create(new CompanyFactoryData(
            $request->get('isAdmin'),
            $request->get('url'),
            $request->get('ssl'),
            $request->request->get('settings') ?? [],
            $request->request->get('descriptions') ?? []
        ));
        return new CompanyResource($company);
    }

    /**
     * @SWG\Put(
     *     path="api/companies/edit/{company_id}",
     *     tags={"Companies"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CompanyRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit company by id",
     *         @SWG\Schema(ref="#/definitions/CompanyResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Company $company
     * @param CompanyRequest $request
     * @return CompanyResource
     */
    public function editAction(Company $company, CompanyRequest $request)
    {
        $company = $this->companyFactory->create(new CompanyFactoryData(
            $request->get('isAdmin'),
            $request->get('url'),
            $request->get('ssl'),
            $request->request->get('settings') ?? [],
            $request->request->get('descriptions') ?? []
        ), $company);
        return new CompanyResource($company);
    }

    /**
     * @SWG\Delete(
     *     path="api/companies/delete/{company_id}",
     *     tags={"Companies"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete company by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Company $company
     * @return JsonResponse
     */
    public function deleteAction(Company $company)
    {
        $this->companyDelete->delete($company);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/companies",
     *     tags={"Companies"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all companies",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CompaniesResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getCompaniesAction()
    {
        return CompaniesResource::collection($this->getCompanies->get());
    }

    /**
     * @SWG\Get(
     *     path="api/companies/show/{company_id}",
     *     tags={"Companies"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show company by id",
     *         @SWG\Schema(ref="#/definitions/CompanyResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Company $company
     * @return CompanyResource
     */
    public function getShowAction(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * @SWG\Get(
     *     path="api/companies/show_by_url/{url}",
     *     tags={"Companies"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show company by url",
     *         @SWG\Schema(ref="#/definitions/CompanyResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Company $company
     * @return CompanyResource
     */
    public function getByUrlAction(Company $company)
    {
        return new CompanyResource($company);
    }
}
