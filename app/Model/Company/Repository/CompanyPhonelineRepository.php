<?php

namespace App\Model\Company\Repository;

use App\Model\Company\Entity\Phoneline\CompanyPhoneline;
use App\Model\Infrastructure\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Log;

class CompanyPhonelineRepository implements RepositoryInterface
{
    public function findOneBy(array $where, ?array $orderBy = []): ?CompanyPhoneline
    {
        $query = CompanyPhoneline::query();
        foreach ($where as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query->get()->first();
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        Log::info(json_encode(CompanyPhoneline::query()->get()));
        return CompanyPhoneline::query()->get();
    }

    public function find(int $id)
    {
        return CompanyPhoneline::query()->find($id);
    }
}
