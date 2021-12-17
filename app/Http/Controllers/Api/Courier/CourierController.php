<?php

namespace App\Http\Controllers\Api\Courier;

use App\Http\Requests\Menu\MenuRequest;
use App\Http\Resources\Courier\CourierResource;
use App\Http\Resources\Menu\MenuResource;
use App\Model\Courier\Entity\Courier;
use App\Model\Courier\Service\Get\ByCompany\GetCouriersByCompanyInterface;
use App\Model\Menu\Entity\Menu;
use App\Model\Menu\Service\Delete\MenuDeleteInterface;
use App\Model\Menu\Service\Factory\MenuFactoryInterface;
use App\Model\Menu\Service\Factory\Data as MenuFactoryData;
use App\Model\Menu\Service\Get\GetMenusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CourierController extends BaseController
{
    private GetCouriersByCompanyInterface $getCouriers;

    public function __construct(GetCouriersByCompanyInterface $getCouriers)
    {
        $this->getCouriers = $getCouriers;
    }

    /**
     * @SWG\Get(
     *     path="api/couriers/by_company",
     *     tags={"CouriersByCompany"},
     *     @SWG\Response(
     *         response=200,
     *         description="Couriers by company",
     *         @SWG\Schema(ref="#/definitions/CourierResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param int $companyId
     * @return AnonymousResourceCollection
     */
    public function getByCompanyAction(int $companyId)
    {
        return CourierResource::collection($this->getCouriers->get($companyId));
    }
}
