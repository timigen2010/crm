<?php

namespace App\Model\User\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_history_login_id
 * @property int $user_id
 * @property string $ip
 */
class UserHistoryLogin extends Model
{
    protected $table = 'user_history_logins';

    protected $primaryKey = 'user_history_login_id';

    protected $fillable = ['user_history_login_id', 'user_id', 'ip'];
}
