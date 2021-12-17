<?php

namespace App\Model\User\Entity\Permission;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_permission_description_id
 * @property int $user_permission_id
 * @property string $description
 * @property int $language_id
 */
class UserPermissionDescription extends Model
{
    protected $table = 'user_permission_descriptions';

    protected $primaryKey = 'user_permission_description_id';

    protected $fillable = ['user_permission_id', 'description', 'language_id'];

    public $timestamps = false;
}
