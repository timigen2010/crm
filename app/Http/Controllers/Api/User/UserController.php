<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\GetUsersRequest;
use App\Http\Requests\User\UserAvatarRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UsersResource;
use App\Model\User\Entity\User;
use App\Model\User\Serivce\DeleteUser\UserDeleteInterface;
use App\Model\User\Service\ChangePassword\ChangePasswordInterface;
use App\Model\User\Service\ChangePassword\Data as ChangePasswordData;
use App\Model\User\Service\EditUser\Avatar\EditAvatarInterface;
use App\Model\User\Service\EditUser\Avatar\Data as EditAvatarData;
use App\Model\User\Service\EditUser\EditUserAbstract;
use App\Model\User\Service\EditUser\Data as EditUserData;
use App\Model\User\Service\GetUsers\GetUsersInterface;
use App\Model\User\Service\GetUsers\GetUsersByParams\Data as GetUsersData;
use App\Model\User\Service\RegisterUser\RegisterService\Data as RegisterData;
use App\Model\User\Service\RegisterUser\RegisterUserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

/**
 * @SWG\Info(title="Crm API", version="1.0")
*/
class UserController extends BaseController
{
    private RegisterUserInterface $registerUser;

    private UserDeleteInterface $userDelete;

    private GetUsersInterface $getUsers;

    private EditUserAbstract $editUser;

    private ChangePasswordInterface $changePassword;

    private EditAvatarInterface $editAvatar;

    public function __construct(RegisterUserInterface $registerUser,
                                UserDeleteInterface $userDelete,
                                GetUsersInterface $getUsers,
                                EditUserAbstract $editUser,
                                ChangePasswordInterface $changePassword,
                                EditAvatarInterface $editAvatar)
    {
        $this->registerUser = $registerUser;
        $this->userDelete = $userDelete;
        $this->getUsers = $getUsers;
        $this->editUser = $editUser;
        $this->changePassword = $changePassword;
        $this->editAvatar = $editAvatar;
    }

    /**
     * @SWG\Post(
     *     path="api/users/register",
     *     tags={"User"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/UserRegisterRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Craete user",
     *         @SWG\Schema(ref="#/definitions/UserResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param UserRegisterRequest $request
     * @return UserResource
    */
    public function registerUserAction(UserRegisterRequest $request)
    {
        $user = $this->registerUser->register(new RegisterData(
            $request->get('userGroupId'),
            $request->get('username'),
            $request->get('password'),
            $request->get('hidePhone'),
            $request->get('status'),
            $request->get('firstName'),
            $request->get('lastName'),
            $request->get('email'),
            $request->get('parentUserId'),
            $request->get('sipPhone'),
            $request->get('sipPassword'),
        ));
        return new UserResource($user);
    }

    /**
     * @SWG\Post(
     *     path="api/users/edit/{user_id}",
     *     tags={"User"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/UserRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit user by id",
     *         @SWG\Schema(ref="#/definitions/UserResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param User $user
     * @param UserRequest $request
     * @return UserResource
     */
    public function editAction(User $user, UserRequest $request)
    {
        $user = $this->editUser->edit(new EditUserData(
            $request->get('userGroupId'),
            $request->get('username'),
            $request->get('hidePhone'),
            $request->get('status'),
            $request->get('firstName'),
            $request->get('lastName'),
            $request->get('email'),
            $request->get('parentUserId'),
            $request->get('sipPhone'),
            $request->get('sipPassword'),
        ), $user);
        return new UserResource($user);
    }

    /**
     * @SWG\Delete(
     *     path="api/users/delete/{user_id}",
     *     tags={"User"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete user by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param User $user
     * @return JsonResponse
     */
    public function deleteAction(User $user)
    {
        $this->userDelete->delete($user);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/users",
     *     tags={"User"},
     *     @SWG\Parameter(name="userGroupId", in="query", required=false, type="integer"),
     *     @SWG\Parameter(name="username", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="status", in="query", required=false, type="boolean"),
     *     @SWG\Parameter(name="orderBy", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="orderDirection", in="query", required=false, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all users",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/UsersResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetUsersRequest $request
     * @return AnonymousResourceCollection
     */
    public function getUsersAction(GetUsersRequest $request)
    {
        return UsersResource::collection($this->getUsers->getUsers(new GetUsersData(
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
            $request->query->get('username'),
            $request->query->get('userGroupId'),
            $request->query->get('status'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/users/show/{user_id}",
     *     tags={"User"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show user by id",
     *         @SWG\Schema(ref="#/definitions/UserResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param User $user
     * @return UserResource
     */
    public function getShowAction(User $user)
    {
        return new UserResource($user);
    }

    /**
     * @SWG\Post(
     *     path="api/users/change_password",
     *     tags={"User"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ChangePasswordRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Change password",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePasswordAction(ChangePasswordRequest $request)
    {
        /** @var User $user */
        $user = $request->user();
        if (!$user->validateForPassportPasswordGrant($request->get('oldPassword'))) {
            return new JsonResponse('Old password is invalid', Response::HTTP_BAD_REQUEST);
        }
        $this->changePassword->changePassword(new ChangePasswordData(
            $request->user(),
            $request->get('newPassword'),
        ));
        return new JsonResponse(true);
    }

    /**
     * @SWG\Post(
     *     path="api/users/avatar/{user_id}",
     *     tags={"User"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/UserAvatarRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Upload avatar for user",
     *         @SWG\Schema(ref="#/definitions/UserResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param User $user
     * @param UserAvatarRequest $request
     * @return UserResource
     */
    public function uploadAvatarAction(User $user, UserAvatarRequest $request)
    {
        $path = $request->file('avatar')->store('avatars', 'public');
        return new UserResource($this->editAvatar->setAvatar(new EditAvatarData("storage/{$path}"), $user));
    }
}
