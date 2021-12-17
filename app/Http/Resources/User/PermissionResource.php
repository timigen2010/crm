<?php

namespace App\Http\Resources\User;

use App\Model\User\Entity\Permission\UserPermissionDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Support\Collection;

/**
 * @property int $user_permission_id
 * @property string $name
 * @property Collection<UserPermissionDescription> $userPermissionDescriptions
 */
class PermissionResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="PermissionResource",
     *     type="object",
     *     @SWG\Property(property="userPermissionId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="userPermissionDescriptionId", type="integer"),
     *              @SWG\Property(property="description", type="string"),
     *              @SWG\Property(property="languageId", type="integer")
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
            'userPermissionId' => $this->user_permission_id,
            'name' => $this->name,
            'descriptions' => $this->userPermissionDescriptions->map(
                function (UserPermissionDescription $description) {
                    return [
                        'userPermissionDescriptionId' => $description->user_permission_description_id,
                        'description' => $description->description,
                        'languageId' => $description->language_id,
                    ];
            })
        ];
    }
}
