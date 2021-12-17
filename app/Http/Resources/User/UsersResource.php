<?php

namespace App\Http\Resources\User;

use App\Model\User\Entity\UserGroup;
use App\Model\User\Entity\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $user_id
 * @property string $username
 * @property bool $status
 * @property bool $hide_phone
 * @property UserGroup $userGroup
 * @property Carbon $created_at
 */
class UsersResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="UsersResource",
     *     type="object",
     *     @SWG\Property(property="userId", type="integer"),
     *     @SWG\Property(property="username", type="string"),
     *     @SWG\Property(property="hidePhone", type="boolean"),
     *     @SWG\Property(property="status", type="boolean"),
     *     @SWG\Property(property="userGroup", type="object",
     *          @SWG\Property(property="userGroupId", type="integer"),
     *          @SWG\Property(property="name", type="string"),
     *      ),
     *     @SWG\Property(property="createdAt", type="string")
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
            'createdAt' => $this->created_at
        ];
    }
}
