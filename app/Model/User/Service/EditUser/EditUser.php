<?php

namespace App\Model\User\Service\EditUser;

use App\Model\User\Entity\User;
use App\Model\User\Entity\UserGroup;
use App\Model\User\Service\GeneratePassword\GeneratePasswordInterface;

class EditUser extends EditUserAbstract
{

    private GeneratePasswordInterface $generatePassword;

    public function __construct(GeneratePasswordInterface $generatePassword)
    {
        $this->generatePassword = $generatePassword;
    }
    /**
     * @param Data $data
     * @param User $user
     * @return User
     * @throws \Throwable
     */
    protected function setData(Data $data, User $user): User
    {
        $userGroup = UserGroup::query()->findOrFail($data->userGroupId);
        $parentUser = $data->parentUserId ? User::query()->findOrFail($data->parentUserId) : null;
        $user->update([
            'username' => $data->username,
            'hide_phone' => $data->hidePhone,
            'status' => $data->status,
        ]);
        $user->userGroup()->associate($userGroup);
        $user->parentUser()->associate($parentUser);
        $user->userProfile()->update([
            'user_id' => $user->user_id,
            'first_name' => $data->firstName,
            'last_name' => $data->lastName,
            'email' => $data->email
        ]);
        $sipData = [
            'user_id' => $user->user_id,
            'phone' => $data->sipPhone,
        ];
        $responseSipGeneratedPassword = $data->sipPassword ? $this->generatePassword->generatePassword($data->sipPassword) : null;
        if($responseSipGeneratedPassword){
            $sipData['salt'] = $responseSipGeneratedPassword->salt;
            $sipData['password'] = $responseSipGeneratedPassword->password;
        }

        $user->userSip()->update($sipData);
        $user->saveOrFail();
        return $user;
    }
}
