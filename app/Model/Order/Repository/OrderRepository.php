<?php

namespace App\Model\Order\Repository;

use App\Model\Order\Entity\Order;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    private Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function getAllBuilder(array $where, ?array $orderBy = [])
    {
        $query = DB::table('orders');
        if (!is_null($where["orderId"])) {
            $query->where("orders.order_id", "=", $where["orderId"]);
        }
        if (!is_null($where["orderStatusId"])) {
            $query->where("orders.order_status_id", "=", $where["orderStatusId"]);
        }
        if (!is_null($where["userGroupId"])) {
            $query->join('users', function (JoinClause $join) use ($where) {
                $join->on('users.user_id', '=', 'orders.user_id')
                    ->where('users.user_group_id', '=', $where["userGroupId"]);
            });
        }
        if (!is_null($where["updatedAt"])) {
            $query->whereDate('orders.updated_at', '=', $where['updatedAt']);
        }
        if (!is_null($where["createdAt"])) {
            $query->whereDate('orders.created_at', '=', $where['createdAt']);
        }
        if (!is_null($where["customerId"])) {
            $query->whereDate('orders.customer_id', '=', $where['customerId']);
        }
        if (!is_null($where["total"])) {
            $query->whereDate('orders.total', '=', $where['total']);
        }
        if (!is_null($where["companyId"])) {
            $query->whereDate('orders.company_id', '=', $where['companyId']);
        }
        if (!is_null($where["companyIds"])) {
            $query->whereIn('orders.company_id', $where['companyIds']);
        }
        $query->where('orders.order_status_id', '<>', 0);
        if ($orderBy) {
            foreach ($orderBy as $key => $item) {
                $query->orderBy("orders.{$key}", $item);
            }
        }
        return $query
            ->join('order_customers', function (JoinClause $join) use ($where) {
                $join->on('orders.order_id', '=', 'order_customers.order_id');
            })
            ->leftJoin('order_statuses', function (JoinClause $join) use ($where) {
                $join->on('orders.order_status_id', '=', 'order_statuses.order_status_id');
            })
            ->select(
                "orders.created_at",
                "orders.updated_at",
                "orders.order_id",
                "orders.order_status_id",
                "orders.user_id",
                "orders.delivery_method",
                "order_customers.first_name",
                "order_statuses.name as status_name",
                "orders.total"
            );
    }

    public function findLastByCustomer(int $customerId){
        return $this->model->query()
            ->join('order_customers', function (JoinClause $join) {
                $join->on('orders.order_id', '=', 'order_customers.order_id');
            })
            ->where('order_customers.customer_id', '=', $customerId)
            ->orderByDesc('orders.order_id')
            ->first();
    }

    public function findOneById(int $orderId)
    {
        return $this->model->query()->find($orderId);
    }
}
