<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Requests\Company\CompanyPhonelineRequest;
use App\Http\Resources\Company\CompanyPhonelineResource;
use App\Http\Resources\Company\CompanyPhonelinesResource;
use App\Model\Company\Entity\Phoneline\CompanyPhoneline;
use App\Model\Company\Service\Phoneline\Delete\CompanyPhonelineDeleteInterface;
use App\Model\Company\Service\Phoneline\Factory\CompanyPhonelineFactoryAbstract;
use App\Model\Company\Service\Phoneline\Factory\Data as CompanyPhonelineFactoryData;
use App\Model\Company\Service\Phoneline\Get\GetCompanyPhonelinesInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CompanyPhonelineController extends BaseController
{
    private CompanyPhonelineFactoryAbstract $companyPhonelineFactory;

    private CompanyPhonelineDeleteInterface $companyPhonelineDelete;

    private GetCompanyPhonelinesInterface $getCompanyPhonelines;

    public function __construct(CompanyPhonelineFactoryAbstract $companyPhonelineFactory,
                                CompanyPhonelineDeleteInterface $ccompanyPhonelineDelete,
                                GetCompanyPhonelinesInterface $getCompanyPhonelines)
    {
        $this->companyPhonelineFactory = $companyPhonelineFactory;
        $this->companyPhonelineDelete = $ccompanyPhonelineDelete;
        $this->getCompanyPhonelines = $getCompanyPhonelines;
    }

    /**
     * @SWG\Post(
     *     path="api/companies/phonelines/new",
     *     tags={"Company phoneline"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CompanyPhonelineRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create company phoneline",
     *         @SWG\Schema(ref="#/definitions/CompanyPhonelineResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CompanyPhonelineRequest $request
     * @return CompanyPhonelineResource
     */
    public function createAction(CompanyPhonelineRequest $request)
    {
        $phoneline = $this->companyPhonelineFactory->create(new CompanyPhonelineFactoryData(
            $request->get('companyId'),
            $request->get('keyword'),
            $request->request->get('descriptions') ?? []
        ));
        return new CompanyPhonelineResource($phoneline);
    }

    /**
     * @SWG\Put(
     *     path="api/companies/phonelines/edit/{company_phoneline_id}",
     *     tags={"Company phoneline"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CompanyPhonelineRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit phoneline by id",
     *         @SWG\Schema(ref="#/definitions/CompanyPhonelineResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CompanyPhoneline $companyPhoneline
     * @param CompanyPhonelineRequest $request
     * @return CompanyPhonelineResource
     */
    public function editAction(CompanyPhoneline $companyPhoneline, CompanyPhonelineRequest $request)
    {
        $companyPhoneline = $this->companyPhonelineFactory->create(new CompanyPhonelineFactoryData(
            $request->get('companyId'),
            $request->get('keyword'),
            $request->request->get('descriptions') ?? []
        ), $companyPhoneline);
        return new CompanyPhonelineResource($companyPhoneline);
    }

    /**
     * @SWG\Delete(
     *     path="api/companies/phonelines/delete/{company_phoneline_id}",
     *     tags={"Company phoneline"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete phoneline by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CompanyPhoneline $companyPhoneline
     * @return JsonResponse
     */
    public function deleteAction(CompanyPhoneline $companyPhoneline)
    {
        $this->companyPhonelineDelete->delete($companyPhoneline);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/companies/phonelines",
     *     tags={"Company phoneline"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all company phonelines",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CompanyPhonelineResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getCompanyPhonelinesAction()
    {
        return CompanyPhonelinesResource::collection($this->getCompanyPhonelines->getPhonelines([]));
    }

    /**
     * @SWG\Get(
     *     path="api/companies/phonelines/show/{company_phoneline_id}",
     *     tags={"Company phoneline"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show company phoneline by id",
     *         @SWG\Schema(ref="#/definitions/CompanyPhonelineResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CompanyPhoneline $companyPhoneline
     * @return CompanyPhonelineResource
     */
    public function getShowAction(CompanyPhoneline $companyPhoneline)
    {
        return new CompanyPhonelineResource($companyPhoneline);
    }
}
