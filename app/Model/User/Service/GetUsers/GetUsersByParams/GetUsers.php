<?php

namespace App\Model\User\Service\GetUsers\GetUsersByParams;

use App\Model\User\Entity\User;
use App\Model\User\Repository\User\UserRepository;
use App\Model\User\Service\GetUsers\GetUsersInterface;
use Illuminate\Database\Eloquent\Collection;

class GetUsers implements GetUsersInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Data $data
     * @return Collection<User>
     */
    public function getUsers($data)
    {
        $where = [];
        if ($data->username) {
            $where['username'] = $data->username;
        }
        if ($data->userGroupId) {
            $where['user_group_id'] = $data->userGroupId;
        }
        if ($data->status) {
            $where['status'] = $data->status;
        }
        $where['deleted'] = false;
        return $this->userRepository->findBy($where, [$data->orderBy => $data->orderDirection])
            ->loadMissing('userGroup');
    }
}
