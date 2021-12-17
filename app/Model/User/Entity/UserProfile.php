<?php

namespace App\Model\User\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $avatar
 */
class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'first_name', 'last_name', 'email'];

    public $timestamps = false;
}
