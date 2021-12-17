<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\User\UserGroupRequest;
use App\Http\Resources\User\UserGroupResource;
use App\Model\User\Entity\UserGroup;
use App\Model\User\Serivce\UserGroup\Delete\UserGroupDeleteInterface;
use App\Model\User\Service\UserGroup\Factory\Data as UserGroupFactoryData;
use App\Model\User\Service\UserGroup\Factory\UserGroupFactoryAbstract;
use App\Model\User\Service\UserGroup\Get\GetUserGroupsInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class UserGroupController extends BaseController
{
    private UserGroupFactoryAbstract $userGroupFactory;

    private UserGroupDeleteInterface $userGroupDelete;

    private GetUserGroupsInterface $getUserGroups;

    public function __construct(UserGroupFactoryAbstract $userGroupFactory,
                                UserGroupDeleteInterface $userGroupDelete,
                                GetUserGroupsInterface $getUserGroups)
    {
        $this->userGroupFactory = $userGroupFactory;
        $this->userGroupDelete = $userGroupDelete;
        $this->getUserGroups = $getUserGroups;
    }

    /**
     * @SWG\Post(
     *     path="api/user_groups/new",
     *     tags={"User group"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/UserGroupRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Craete user group",
     *         @SWG\Schema(ref="#/definitions/UserGroupResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UserGroupRequest $request
     * @return UserGroupResource
     */
    public function createAction(UserGroupRequest $request)
    {
        $userGroup = $this->userGroupFactory->create(new UserGroupFactoryData(
            $request->get('name'),
            $request->request->get('permissions') ?? []
        ));
        return new UserGroupResource($userGroup);
    }

    /**
     * @SWG\Put(
     *     path="api/user_groups/edit/{user_group_id}",
     *     tags={"User group"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/UserGroupRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit user group by id",
     *         @SWG\Schema(ref="#/definitions/UserGroupResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UserGroup $userGroup
     * @param UserGroupRequest $request
     * @return UserGroupResource
     */
    public function editAction(UserGroup $userGroup, UserGroupRequest $request)
    {
        $userGroup = $this->userGroupFactory->create(new UserGroupFactoryData(
            $request->get('name'),
            $request->request->get('permissions') ?? []
        ), $userGroup);
        return new UserGroupResource($userGroup);
    }

    /**
     * @SWG\Delete(
     *     path="api/user_groups/delete/{user_group_id}",
     *     tags={"User group"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete user group by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UserGroup $userGroup
     * @return JsonResponse
     */
    public function deleteAction(UserGroup $userGroup)
    {
        $this->userGroupDelete->delete($userGroup);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/user_groups",
     *     tags={"User group"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all user groups",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/UserGroupResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getUserGroupsAction()
    {
        return UserGroupResource::collection($this->getUserGroups->getUserGroups([]));
    }

    /**
     * @SWG\Get(
     *     path="api/user_groups/show/{user_group_id}",
     *     tags={"User group"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get group by id",
     *         @SWG\Schema(ref="#/definitions/UserGroupResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UserGroup $userGroup
     * @return UserGroupResource
     */
    public function showAction(UserGroup $userGroup)
    {
        return new UserGroupResource($userGroup);
    }
}
