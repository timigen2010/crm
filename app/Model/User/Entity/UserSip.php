<?php

namespace App\Model\User\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $phone
 * @property string $salt
 * @property string $password
 */
class UserSip extends Model
{
    protected $table = 'user_sips';

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'phone', 'salt', 'password'];

    public $timestamps = false;

    /**
     * Validate the password of the user sip.
     *
     * @param  string  $password
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        $hash = sha1($this->salt . sha1($this->salt . sha1($password)));
        return $this->password === $hash;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
