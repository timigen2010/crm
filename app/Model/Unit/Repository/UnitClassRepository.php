<?php

namespace App\Model\Unit\Repository;

use App\Model\Infrastructure\Contracts\RepositoryInterface;
use App\Model\Language\Entity\Language;
use App\Model\Unit\Entity\UnitClass;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class UnitClassRepository
{
    private UnitClass $model;

    public function __construct(UnitClass $model)
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
            'update unit_classes set main_class_id = ?, value = value / ? where main_class_id is null',
            [$mainClassId, $value]
        );
    }

    public function getSimpleInfo(?int $languageId = null)
    {
        $languageId ??= Language::RU_ID;
        return $this->model->query()
            ->leftJoin('unit_class_descriptions', function (JoinClause $join) {
                $join->on('unit_classes.unit_class_id', '=', 'unit_class_descriptions.unit_class_id');
            })
            ->where("unit_class_descriptions.language_id", "=", $languageId)
            ->select(["unit_classes.unit_class_id as unitClassId", "unit_class_descriptions.unit"])->get()->toArray();
    }
}
