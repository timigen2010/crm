<?php

namespace App\Model\User\Repository\User;

use App\Model\Infrastructure\Contracts\RepositoryInterface;
use App\Model\User\Entity\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements RepositoryInterface
{
    public function findOneBy(array $where): ?User
    {
        $query = User::query();
        foreach ($where as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query->get()->first();
    }

    /**
     * @param array $where
     * @param array|null $orderBy
     * @return Collection<User>
     */
    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = User::query();
        foreach ($where as $key => $value) {
            $query->where($key, '=', $value);
        }
        foreach ($orderBy as $key => $value) {
            $query->orderBy($key, $value);
        }
        return $query->get();
    }

    public function find(int $id)
    {
        return User::query()->find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::query()
            ->join(
            "user_profiles",
            "user_profiles.user_id",
            "=",
            "users.user_id")
            ->where("user_profiles.email", "=", $email)
            ->where("users.deleted", "=", false)
            ->get()->first();
    }
}
