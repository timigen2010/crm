<?php

namespace App\Http\Resources\User;

use App\Model\User\Entity\Permission\UserPermission;
use App\Model\User\Entity\Permission\UserPermissionDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Support\Collection;

/**
 * @property int $user_group_id
 * @property string $name
 * @property Collection<UserPermission> $permissions
 */
class UserGroupResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="UserGroupResource",
     *     type="object",
     *     @SWG\Property(property="userGroupId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="permissions", type="array",
     *          @SWG\Items(type="object",
     *               @SWG\Property(property="userPermissionId", type="integer"),
     *               @SWG\Property(property="name", type="string"),
     *               @SWG\Property(property="userPermissionDescriptions", type="array",
     *                  @SWG\Items(type="object",
     *                      @SWG\Property(property="userPermissionDescriptionId", type="integer"),
     *                      @SWG\Property(property="description", type="string"),
     *                      @SWG\Property(property="languageId", type="integer")
     *                  )
     *              ),
     *          )
     *      ),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'userGroupId' => $this->user_group_id,
            'name' => $this->name,
            'permissions' => $this->permissions->map(
                function (UserPermission $permission) {
                    return [
                        'userPermissionId' => $permission->user_permission_id,
                        'name' => $permission->name,
                        'userPermissionDescriptions' =>  $permission->userPermissionDescriptions->map(
                            function (UserPermissionDescription $description) {
                                return [
                                    'userPermissionDescriptionId' => $description->user_permission_description_id,
                                    'description' => $description->description,
                                    'languageId' => $description->language_id,
                                ];
                            }),
                    ];
                })
        ];
    }
}
