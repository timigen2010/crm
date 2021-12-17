<?php

namespace App\Model\User\Service\RegisterUser\RegisterService;

class Data
{
    public int $user_group_id;

    public ?int $parent_user_id;

    public string $username;

    public string $password;

    public bool $hide_phone;

    public bool $status;

    public string $firstName;

    public string $lastName;

    public string $email;

    public ?string $sip_phone;

    public ?string $sip_password;

    public function __construct(int $user_group_id,
                                string $username,
                                string $password,
                                bool $hide_phone,
                                bool $status,
                                string $firstName,
                                string $lastName,
                                string $email,
                                ?int $parent_user_id = null,
                                ?string $sip_phone = null,
                                ?string $sip_password = null)
    {
        $this->user_group_id = $user_group_id;
        $this->parent_user_id = $parent_user_id;
        $this->username = $username;
        $this->password = $password;
        $this->hide_phone = $hide_phone;
        $this->status = $status;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->sip_phone = $sip_phone;
        $this->sip_password = $sip_password;
    }


}
