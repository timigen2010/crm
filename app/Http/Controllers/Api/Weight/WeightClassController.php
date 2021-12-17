<?php

namespace App\Http\Controllers\Api\Weight;

use App\Http\Requests\Weight\GetWeightClassesRequest;
use App\Http\Requests\Weight\WeightClassRequest;
use App\Http\Resources\Weight\WeightClassesResource;
use App\Http\Resources\Weight\WeightClassResource;
use App\Model\Weight\Entity\WeightClass;
use App\Model\Weight\Serivce\Rebind\RebindInterface;
use App\Model\Weight\Service\Delete\WeightClassDeleteInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use App\Model\Weight\Service\Factory\WeightClassFactoryInterface;
use App\Model\Weight\Service\Factory\Data as WeightClassFactoryData;
use App\Model\Weight\Service\Get\GetWeightClassesInterface;
use App\Model\Weight\Service\Get\GetWeights\Data as GetWeightClassesData;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WeightClassController extends BaseController
{
    private WeightClassFactoryInterface $weightClassFactory;

    private WeightClassDeleteInterface $weightClassDelete;

    private GetWeightClassesInterface $getWeightClasses;

    private RebindInterface $rebind;

    public function __construct(WeightClassFactoryInterface $weightClassFactory,
                                WeightClassDeleteInterface $weightClassDelete,
                                GetWeightClassesInterface $getWeightClasses,
                                RebindInterface $rebind)
    {
        $this->weightClassFactory = $weightClassFactory;
        $this->weightClassDelete = $weightClassDelete;
        $this->getWeightClasses = $getWeightClasses;
        $this->rebind = $rebind;
    }

    /**
     * @SWG\Post(
     *     path="api/weight_classes/new",
     *     tags={"Weight classes"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/WeightClassRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create weight class",
     *         @SWG\Schema(ref="#/definitions/WeightClassResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param WeightClassRequest $request
     * @return WeightClassResource
     */
    public function createAction(WeightClassRequest $request)
    {
        $weightClass = $this->weightClassFactory->create(new WeightClassFactoryData(
            $request->request->get('mainClassId'),
            $request->request->get('value'),
            $request->request->get('descriptions') ?? [],
        ));
        return new WeightClassResource($weightClass);
    }

    /**
     * @SWG\Put(
     *     path="api/weight_classes/{weight_class_id}/edit",
     *     tags={"Weight classes"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/WeightClassRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit weight class by id",
     *         @SWG\Schema(ref="#/definitions/WeightClassResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param WeightClass $weightClass
     * @param WeightClassRequest $request
     * @return WeightClassResource
     */
    public function editAction(WeightClass $weightClass, WeightClassRequest $request)
    {
        $weightClass = $this->weightClassFactory->create(new WeightClassFactoryData(
            $request->request->get('mainClassId'),
            $request->request->get('value'),
            $request->request->get('descriptions') ?? [],
        ), $weightClass);
        return new WeightClassResource($weightClass);
    }

    /**
     * @SWG\Delete(
     *     path="api/weight_classes/{weight_class_id}/delete",
     *     tags={"Weight classes"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete weight class by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param WeightClass $weightClass
     * @return JsonResponse
     */
    public function deleteAction(WeightClass $weightClass)
    {
        $this->weightClassDelete->delete($weightClass);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/weight_classes",
     *     tags={"Weight classes"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GetWeightClassesRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all weight classes",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/WeightClassesResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetWeightClassesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getWeightsAction(GetWeightClassesRequest $request)
    {
        return WeightClassesResource::collection($this->getWeightClasses->getWeights(new GetWeightClassesData(
            $request->query->get('languageId'),
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/weight_classes/{weight_class_id}/show",
     *     tags={"Weight classes"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show weight class by id",
     *         @SWG\Schema(ref="#/definitions/WeightClassResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param WeightClass $weightClass
     * @return WeightClassResource
     */
    public function getShowAction(WeightClass $weightClass)
    {
        if ($weightClass->deleted) {
            throw new NotFoundHttpException('Weight class not found');
        }
        return new WeightClassResource($weightClass);
    }

    /**
     * @SWG\Post(
     *     path="api/weight_classes/{weight_class_id}/rebind",
     *     tags={"Weight classes"},
     *     @SWG\Response(
     *         response=200,
     *         description="Rebind weight class by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param WeightClass $weightClass
     * @return JsonResponse
     */
    public function rebindAction(WeightClass $weightClass)
    {
        $this->rebind->rebind($weightClass);
        return new JsonResponse(true);
    }
}
