<?php

namespace App\Http\Controllers\Api\Menu;

use App\Http\Requests\Menu\MenuRequest;
use App\Http\Resources\Menu\MenuResource;
use App\Model\Menu\Entity\Menu;
use App\Model\Menu\Service\Delete\MenuDeleteInterface;
use App\Model\Menu\Service\Factory\MenuFactoryInterface;
use App\Model\Menu\Service\Factory\Data as MenuFactoryData;
use App\Model\Menu\Service\Get\GetMenusInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class MenuController extends BaseController
{
    private MenuFactoryInterface $menuFactory;

    private MenuDeleteInterface $menuDelete;

    private GetMenusInterface $getMenus;

    public function __construct(MenuFactoryInterface $menuFactory,
                                MenuDeleteInterface $menuDelete,
                                GetMenusInterface $getMenus)
    {
        $this->menuFactory = $menuFactory;
        $this->menuDelete = $menuDelete;
        $this->getMenus = $getMenus;
    }

    /**
     * @SWG\Post(
     *     path="api/menus/new",
     *     tags={"Menus"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MenuRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create menu",
     *         @SWG\Schema(ref="#/definitions/MenuResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param MenuRequest $request
     * @return MenuResource
     */
    public function createAction(MenuRequest $request)
    {
        $menu = $this->menuFactory->create(new MenuFactoryData(
            $request->request->get('name'),
            $request->request->get('companies'),
        ));
        return new MenuResource($menu);
    }

    /**
     * @SWG\Put(
     *     path="api/menus/edit/{menu_id}",
     *     tags={"Menus"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MenuRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit menu by id",
     *         @SWG\Schema(ref="#/definitions/MenuResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Menu $menu
     * @param MenuRequest $request
     * @return MenuResource
     */
    public function editAction(Menu $menu, MenuRequest $request)
    {
        $menu = $this->menuFactory->create(new MenuFactoryData(
            $request->request->get('name'),
            $request->request->get('companies'),
        ), $menu);
        return new MenuResource($menu);
    }

    /**
     * @SWG\Delete(
     *     path="api/menus/delete/{menu_id}",
     *     tags={"Menus"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete menu by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Menu $menu
     * @return JsonResponse
     */
    public function deleteAction(Menu $menu)
    {
        $this->menuDelete->delete($menu);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/menus",
     *     tags={"Menus"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all menus",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/MenuResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getMenusAction()
    {
        return MenuResource::collection($this->getMenus->get());
    }

    /**
     * @SWG\Get(
     *     path="api/menus/show/{menu_id}",
     *     tags={"Menus"},
     *     @SWG\Response(
     *         response=200,
     *         description="Menu by id",
     *         @SWG\Schema(ref="#/definitions/MenuResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Menu $menu
     * @return MenuResource
     */
    public function getShowAction(Menu $menu)
    {
        return new MenuResource($menu);
    }
}
