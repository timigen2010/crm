<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\User\PermissionRequest;
use App\Http\Resources\User\PermissionResource;
use App\Model\User\Entity\Permission\UserPermission;
use App\Model\User\Repository\User\UserRepository;
use App\Model\User\Serivce\Permission\Delete\PermissionDeleteInterface;
use App\Model\User\Service\Permission\Factory\PermissionFactoryAbstract;
use App\Model\User\Service\Permission\Factory\Data as PermissionFactoryData;
use App\Model\User\Service\Permission\Get\GetPermissionsInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Swagger\Annotations as SWG;

class PermissionController extends BaseController
{
    private PermissionFactoryAbstract $permissionFactory;

    private PermissionDeleteInterface $permissionDelete;

    private GetPermissionsInterface $getPermissions;

    private UserRepository $userRepository;

    public function __construct(PermissionFactoryAbstract $permissionFactory,
                                PermissionDeleteInterface $permissionDelete,
                                GetPermissionsInterface $getPermissions,
                                UserRepository $userRepository)
    {
        $this->permissionFactory = $permissionFactory;
        $this->permissionDelete = $permissionDelete;
        $this->getPermissions = $getPermissions;
        $this->userRepository = $userRepository;
    }

    /**
     * @SWG\Post(
     *     path="api/user_permissions/new",
     *     tags={"User permission"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PermissionRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Craete permission",
     *         @SWG\Schema(ref="#/definitions/PermissionResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param PermissionRequest $request
     * @return PermissionResource
     */
    public function createAction(PermissionRequest $request)
    {
        $permission = $this->permissionFactory->create(new PermissionFactoryData(
            $request->get('name'),
            $request->request->get('descriptions') ?? []
        ));
        return new PermissionResource($permission);
    }

    /**
     * @SWG\Put(
     *     path="api/user_permissions/edit/{permission_id}",
     *     tags={"User permission"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PermissionRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit permission by id",
     *         @SWG\Schema(ref="#/definitions/PermissionResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UserPermission $permission
     * @param PermissionRequest $request
     * @return PermissionResource
     */
    public function editAction(UserPermission $permission, PermissionRequest $request)
    {
        $permission = $this->permissionFactory->create(new PermissionFactoryData(
            $request->request->get('name'),
            $request->request->get('descriptions') ?? []
        ), $permission);
        return new PermissionResource($permission);
    }

    /**
     * @SWG\Delete(
     *     path="api/user_permissions/delete/{permission_id}",
     *     tags={"User permission"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete permission by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UserPermission $permission
     * @return JsonResponse
     */
    public function deleteAction(UserPermission $permission)
    {
        $this->permissionDelete->delete($permission);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/user_permissions",
     *     tags={"User permission"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all permissions",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/PermissionResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getPermissionsAction()
    {
        return PermissionResource::collection($this->getPermissions->getPermissions([]));
    }

    /**
     * @SWG\Get(
     *     path="api/user_permissions/by_auth_user",
     *     tags={"User permission"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all permissions by auth user",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/PermissionResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getAuthUserPermissionsAction()
    {
        $user = $this->userRepository->find(Auth::id());
        return PermissionResource::collection($user->userGroup->permissions);
    }

    /**
     * @SWG\Get(
     *     path="api/user_permissions/show/{permission_id}",
     *     tags={"User permission"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get permission by id",
     *         @SWG\Schema(ref="#/definitions/PermissionResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UserPermission $permission
     * @return PermissionResource
     */
    public function showAction(UserPermission $permission)
    {
        return new PermissionResource($permission);
    }
}
