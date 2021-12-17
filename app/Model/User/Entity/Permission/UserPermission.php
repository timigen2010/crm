<?php

namespace App\Model\User\Entity\Permission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $user_permission_id
 * @property string $name
 * @property Collection<UserPermissionDescription> $userPermissionDescriptions
 */
class UserPermission extends Model
{
    protected $table = 'user_permissions';

    protected $primaryKey = 'user_permission_id';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function userPermissionDescriptions()
    {
        return $this->hasMany(
            UserPermissionDescription::class,
            'user_permission_id',
            'user_permission_id'
        );
    }
}
