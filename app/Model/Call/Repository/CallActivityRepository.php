<?php

namespace App\Model\Call\Repository;

use App\Model\Call\Entity\CallActivity;
use App\Model\Infrastructure\Contracts\RepositoryInterface;

class CallActivityRepository implements RepositoryInterface
{
    public function findCheckCall(int $userId){
        $query = CallActivity::query()->with('statusDial');

//        $query->distinct();

        $query->orWhere(function ($query) use ($userId) {
            $query->where('source_type', '=', 1);
            $query->where('source_id', '=', $userId);
        });

        $query->orWhere(function ($query) use ($userId) {
            $query->where('destination_type', '=', 1);
            $query->where('destination_id', '=', $userId);
        });

        $query->orderBy('call_activity_id', 'desc');

        return $query->get()->first();
    }

    public function findCallNew(?string $source = '', ?string $destination = ''){
        $query = CallActivity::query();

        $query->where(function ($query) use ($source, $destination) {
            $query->whereIn('source', [$source, $destination]);
            $query->orWhereIn('destination', [$source, $destination]);
        });
        $query->where('status_dial', '=', 'new');
        $query->orderBy('date_start', 'desc');

        return $query->get()->first();
    }

    public function findCallBridgeORDialBegin(string $uniqueId, ?string $source = '', ?string $destination = ''){
        $query = CallActivity::query();

        $query->where(function ($query) use ($source, $destination) {
            $query->whereIn('source', [$source, $destination]);
            $query->orWhereIn('destination', [$source, $destination]);
        });
        $query->where(function ($query) {
            $query->where('status_dial', 'like', 'Bridge');
            $query->orWhere('status_dial', 'like', 'DialBegin');
        });
        $query->orderBy('date_start', 'desc');

        return $query->get()->first();
    }

    public function findCallUnique(string $uniqueId){
        return $this->findOneBy(['unique_id' => $uniqueId], ['call_activity_id'=>'desc']);
    }

    public function findOneBy(array $where, ?array $orderBy = [])
    {
        $query = CallActivity::query();
        foreach ($where as $key => $value) {
            $query->where($key, '=', $value);
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        return $query->get()->first();
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = CallActivity::query();
        if ($where['source']) {
            $query->where('source', 'like', "%{$where['source']}%");
        }
        if ($where['destination']) {
            $query->where('destination', 'like', "%{$where['destination']}%");
        }
        if ($where['companyId']) {
            $query->where('company_id', '=', $where['companyId']);
        }
        if ($where['statusDisposition']) {
            $query->where('disposition', '=', $where['statusDisposition']);
        }
        if ($where['dateStart']) {
            $query->whereDate('date_start', '=', $where['dateStart']);
        }
        if ($where['dateEnd']) {
            $query->whereDate('date_end', '=', $where['dateEnd']);
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        return $query->get();
    }

    public function find(int $id)
    {
        return CallActivity::query()->find($id);
    }
}
