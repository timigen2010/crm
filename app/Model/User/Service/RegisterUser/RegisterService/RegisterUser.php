<?php

namespace App\Model\User\Service\RegisterUser\RegisterService;

use App\Model\User\Entity\User;
use App\Model\User\Entity\UserGroup;
use App\Model\User\Entity\UserProfile;
use App\Model\User\Service\GeneratePassword\GeneratePasswordInterface;
use App\Model\User\Service\RegisterUser\RegisterUserInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Throwable;

class RegisterUser implements RegisterUserInterface
{
    private GeneratePasswordInterface $generatePassword;

    public function __construct(GeneratePasswordInterface $generatePassword)
    {
        $this->generatePassword = $generatePassword;
    }

    /**
     * @param Data $data
     * @return User
     * @throws ModelNotFoundException
     * @throws Throwable
     */
    public function register($data)
    {
        $responseGeneratedPassword = $this->generatePassword->generatePassword($data->password);
        $responseSipGeneratedPassword = $this->generatePassword->generatePassword($data->sip_password);
        $userGroup = UserGroup::query()->findOrFail($data->user_group_id);
        $parentUser = $data->parent_user_id ? User::query()->findOrFail($data->parent_user_id) : null;
        return DB::transaction(function () use ($data, $responseGeneratedPassword, $responseSipGeneratedPassword, $userGroup, $parentUser) {
            /** @var User $user */
            $user = User::query()->make([
                'username' => $data->username,
                'password' => $responseGeneratedPassword->password,
                'salt' => $responseGeneratedPassword->salt,
                'hide_phone' => $data->hide_phone,
                'status' => $data->status,
            ]);
            $user->userGroup()->associate($userGroup);
            $user->parentUser()->associate($parentUser);
            $user->saveOrFail();
            $user->userProfile()->create([
                'user_id' => $user->user_id,
                'first_name' => $data->firstName,
                'last_name' => $data->lastName,
                'email' => $data->email
            ]);
            $user->userSip()->create([
                'user_id' => $user->user_id,
                'phone' => $data->sip_phone,
                'salt' => $responseSipGeneratedPassword->salt,
                'password' => $responseSipGeneratedPassword->password
            ]);
            return $user;
        });
    }
}
