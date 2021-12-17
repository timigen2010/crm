<?php

namespace App\Model\User\Service\EditUser;

class Data
{
    public int $userGroupId;

    public ?int $parentUserId;

    public string $username;

    public bool $hidePhone;

    public bool $status;

    public string $firstName;

    public string $lastName;

    public string $email;

    public ?string $sipPhone;

    public ?string $sipPassword;

    public function __construct(int $userGroupId,
                                string $username,
                                bool $hidePhone,
                                bool $status,
                                string $firstName,
                                string $lastName,
                                string $email,
                                ?int $parentUserId = null,
                                ?string $sipPhone = null,
                                ?string $sipPassword = null)
    {
        $this->userGroupId = $userGroupId;
        $this->parentUserId = $parentUserId;
        $this->username = $username;
        $this->hidePhone = $hidePhone;
        $this->status = $status;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->sipPhone = $sipPhone;
        $this->sipPassword = $sipPassword;
    }


}
