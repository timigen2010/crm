<?php

namespace App\Model\User\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;

/**
 * @property int $user_id
 * @property int $user_group_id
 * @property int $parent_user_id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property bool $status
 * @property bool $hide_phone
 * @property string $confirm_token
 * @property bool $deleted
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property UserGroup $userGroup
 * @property UserProfile $userProfile
 * @property User $parentUser
 * @property User[] $childUsers
 * @property Collection<UserHistoryLogin> $historyLogins
*/
class User extends Model
{
    use HasApiTokens;

    protected $fillable = ['username', 'password', 'salt', 'status', 'hide_phone', 'confirm_token', 'deleted'];

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public function userSip(){
        return $this->hasOne(UserSip::class, 'user_id', 'user_id');
    }

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'user_id');
    }

    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'user_group_id', 'user_group_id');
    }

    public function parentUser()
    {
        return $this->belongsTo(User::class, 'parent_user_id', 'user_id');
    }

    public function childUsers()
    {
        return $this->hasMany(User::class, 'parent_user_id', 'user_id');
    }

    public function historyLogins()
    {
        return $this->hasMany(UserHistoryLogin::class, 'user_id', 'user_id');
    }

    /**
     * Find the user instance for the given username.
     * @param  string  $username
     * @return User
     */
    public function findForPassport(string $username): User
    {
        return $this
            ->where('username', $username)
            ->where('deleted', false)
            ->first();
    }

    /**
     * Validate the password of the user for the Passport password grant.
     *
     * @param  string  $password
     * @return bool
     */
    public function validateForPassportPasswordGrant(string $password): bool
    {
        $hash = sha1($this->salt . sha1($this->salt . sha1($password)));
        return $this->password === $hash;
    }

    public function getAuthIdentifier()
    {
        return $this->user_id;
    }

    public function getAuthIdentifierName()
    {
        return "user_id";
    }
}
