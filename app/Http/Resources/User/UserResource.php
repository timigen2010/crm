<?php

namespace App\Http\Resources\User;

use App\Model\User\Entity\UserGroup;
use App\Model\User\Entity\UserProfile;
use App\Model\User\Entity\UserSip;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $user_id
 * @property string $username
 * @property bool $status
 * @property bool $hide_phone
 * @property UserGroup $userGroup
 * @property UserProfile $userProfile
 * @property UserSip $userSip
 */
class UserResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="UserResource",
     *     type="object",
     *     @SWG\Property(property="userId", type="integer"),
     *     @SWG\Property(property="username", type="string"),
     *     @SWG\Property(property="hidePhone", type="boolean"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="userGroup", type="object",
     *          @SWG\Property(property="userGroupId", type="integer"),
     *          @SWG\Property(property="name", type="string"),
     *      ),
     *     @SWG\Property(property="userProfile", type="object",
     *          @SWG\Property(property="firstName", type="string"),
     *          @SWG\Property(property="lastName", type="string"),
     *          @SWG\Property(property="email", type="string"),
     *          @SWG\Property(property="avatar", type="string"),
     *      ),
     *     @SWG\Property(property="userSip", type="object",
     *          @SWG\Property(property="sipPhone", type="string"),
     *     ),
     * )
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'userId' => $this->user_id,
            'username' => $this->username,
            'hidePhone' => $this->hide_phone,
            'status' => $this->status,
            'userGroup' => [
                'userGroupId' => $this->userGroup->user_group_id,
                'name' => $this->userGroup->name,
            ],
            'userProfile' => $this->userProfile ? [
                'firstName' => $this->userProfile->first_name,
                'lastName' => $this->userProfile->last_name,
                'email' => $this->userProfile->email,
                'avatar' => $this->userProfile->avatar
            ] : [],
            'userSip' => $this->userSip ? [
                'phone' => $this->userSip->phone
            ] : [
                'phone' => ''
            ]
        ];
    }
}
