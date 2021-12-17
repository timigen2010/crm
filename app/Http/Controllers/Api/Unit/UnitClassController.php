<?php

namespace App\Http\Controllers\Api\Unit;

use App\Http\Requests\Unit\GetUnitClassesRequest;
use App\Http\Requests\Unit\UnitClassRequest;
use App\Http\Resources\Unit\UnitClassesResource;
use App\Http\Resources\Unit\UnitClassResource;
use App\Model\Unit\Entity\UnitClass;
use App\Model\Unit\Service\Delete\UnitClassDeleteInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use App\Model\Unit\Service\Factory\UnitClassFactoryInterface;
use App\Model\Unit\Service\Factory\Data as UnitClassFactoryData;
use App\Model\Unit\Service\Get\GetUnitClassesInterface;
use App\Model\Unit\Service\Get\GetUnits\Data as GetUnitClassesData;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UnitClassController extends BaseController
{
    private UnitClassFactoryInterface $unitClassFactory;

    private UnitClassDeleteInterface $unitClassDelete;

    private GetUnitClassesInterface $getUnitClasses;

    public function __construct(UnitClassFactoryInterface $unitClassFactory,
                                UnitClassDeleteInterface $unitClassDelete,
                                GetUnitClassesInterface $getUnitClasses)
    {
        $this->unitClassFactory = $unitClassFactory;
        $this->unitClassDelete = $unitClassDelete;
        $this->getUnitClasses = $getUnitClasses;
    }

    /**
     * @SWG\Post(
     *     path="api/unit_classes/new",
     *     tags={"Unit classes"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/UnitClassRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create unit class",
     *         @SWG\Schema(ref="#/definitions/UnitClassResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UnitClassRequest $request
     * @return UnitClassResource
     */
    public function createAction(UnitClassRequest $request)
    {
        $unitClass = $this->unitClassFactory->create(new UnitClassFactoryData(
            $request->request->get('mainClassId'),
            $request->request->get('value'),
            $request->request->get('descriptions') ?? [],
        ));
        return new UnitClassResource($unitClass);
    }

    /**
     * @SWG\Put(
     *     path="api/unit_classes/edit/{unit_class_id}",
     *     tags={"Unit classes"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/UnitClassRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit unit class by id",
     *         @SWG\Schema(ref="#/definitions/UnitClassResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UnitClass $unitClass
     * @param UnitClassRequest $request
     * @return UnitClassResource
     */
    public function editAction(UnitClass $unitClass, UnitClassRequest $request)
    {
        $unitClass = $this->unitClassFactory->create(new UnitClassFactoryData(
            $request->request->get('mainClassId'),
            $request->request->get('value'),
            $request->request->get('descriptions') ?? [],
        ), $unitClass);
        return new UnitClassResource($unitClass);
    }

    /**
     * @SWG\Delete(
     *     path="api/unit_classes/delete/{unit_class_id}",
     *     tags={"Unit classes"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete unit class by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UnitClass $unitClass
     * @return JsonResponse
     */
    public function deleteAction(UnitClass $unitClass)
    {
        $this->unitClassDelete->delete($unitClass);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/unit_classes",
     *     tags={"Unit classes"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GetUnitClassesRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all unit classes",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/UnitClassesResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetUnitClassesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getUnitsAction(GetUnitClassesRequest $request)
    {
        return UnitClassesResource::collection($this->getUnitClasses->getUnits(new GetUnitClassesData(
            $request->query->get('languageId'),
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/unit_classes/show/{unit_class_id}",
     *     tags={"Unit classes"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show unit class by id",
     *         @SWG\Schema(ref="#/definitions/UnitClassResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UnitClass $unitClass
     * @return UnitClassResource
     */
    public function getShowAction(UnitClass $unitClass)
    {
        if ($unitClass->deleted) {
            throw new NotFoundHttpException('Unit class not found');
        }
        return new UnitClassResource($unitClass);
    }
}
