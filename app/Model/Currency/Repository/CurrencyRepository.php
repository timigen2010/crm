<?php

namespace App\Model\Currency\Repository;

use App\Model\Currency\Entity\Currency;
use App\Model\Infrastructure\Contracts\RepositoryInterface;
use App\Model\Language\Entity\Language;
use Illuminate\Database\Query\JoinClause;

class CurrencyRepository
{
    private Currency $model;

    public function __construct(Currency $model)
    {
        $this->model = $model;
    }

    public function findOneBy(array $where)
    {
        $query = $this->model->query();
        foreach ($where as $key => $item) {
            $query->where($key, $item);
        }
        return $query->first();
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        $query = $this->model->query();
        if (!is_null($where['deleted'])) {
            $query->where('deleted', $where['deleted']);
        }
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy($key, $item);
            }
        }
        return $query->get();
    }

    public function getSimpleInfo(?int $languageId = null)
    {
        $languageId ??= Language::RU_ID;
        return $this->model->query()
            ->leftJoin('currency_descriptions', function (JoinClause $join) {
                $join->on('currencies.currency_id', '=', 'currency_descriptions.currency_id');
            })
            ->where("currency_descriptions.language_id", "=", $languageId)
            ->select(["currencies.currency_id as currencyId", "currency_descriptions.name"])->get()->toArray();
    }
}
