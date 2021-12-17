<?php

namespace App\Model\User\Entity;

use App\Model\User\Entity\Permission\UserPermission;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_group_id
 * @property string $name
 * @property UserPermission[] $permissions
 */
class UserGroup extends Model
{
    protected $table = 'user_groups';

    protected $primaryKey = 'user_group_id';

    public $timestamps = false;

    public function permissions()
    {
        return $this->belongsToMany(
            UserPermission::class,
            'user_groups_to_permissions',
            'user_group_id',
            'user_permission_id'
        );
    }
}
