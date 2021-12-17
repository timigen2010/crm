<?php

namespace App\Model\Menu\Repository;

use App\Model\Menu\Entity\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuRepository
{
    private Menu $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function findBy(array $where = [], ?array $orderBy = [])
    {
        return $this->model->query()->orderBy('name', 'asc')->get();
    }

    public function getMenuIdsByCategoryIds(array $ids): array
    {
        return DB::table('menus as m')
            ->join(
                'categories_to_menus as ctm',
                'ctm.menu_id',
                '=',
                'm.menu_id'
            )
            ->whereIn('ctm.category_id', $ids)
            ->pluck('m.menu_id')->toArray();
    }

    public function getSimpleInfo()
    {
        return $this->model->query()->select(["menu_id as menuId", "name"])->get()->toArray();
    }

    public function getSimpleInfoAuthorized(){
        return DB::table('menus as m')->select(["m.menu_id as menuId", "m.name"])
            ->join(
                'menus_to_companies as mtc',
                'mtc.menu_id',
                '=',
                'm.menu_id'
            )
            ->join(
                'users_to_companies as utc',
                'utc.company_id',
                '=',
                'mtc.company_id'
            )
            ->where('utc.user_id', '=', Auth::id())
            ->groupBy('m.menu_id')
            ->get()->toArray();
    }
}
