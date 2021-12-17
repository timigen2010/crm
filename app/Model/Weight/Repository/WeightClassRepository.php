<?php

namespace App\Model\Weight\Repository;

use App\Model\Infrastructure\Contracts\RepositoryInterface;
use App\Model\Language\Entity\Language;
use App\Model\Weight\Entity\WeightClass;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class WeightClassRepository
{
    private WeightClass $model;

    public function __construct(WeightClass $model)
    {
        $this->model = $model;
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

    public function updateDefaultClasses(int $mainClassId, float $value)
    {
        DB::update(
            'update weight_classes set main_class_id = ?, value = value / ? where main_class_id is null',
            [$mainClassId, $value]
        );
    }

    public function getSimpleInfo(?int $languageId = null)
    {
        $languageId ??= Language::RU_ID;
        return $this->model->query()
            ->leftJoin('weight_class_descriptions', function (JoinClause $join) {
                $join->on('weight_classes.weight_class_id', '=', 'weight_class_descriptions.weight_class_id');
            })
            ->where("weight_class_descriptions.language_id", "=", $languageId)
            ->select(["weight_classes.weight_class_id as weightClassId", "weight_class_descriptions.unit"])->get()->toArray();
    }
}
