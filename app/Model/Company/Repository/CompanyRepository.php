<?php

namespace App\Model\Company\Repository;

use App\Model\Company\Entity\Company;
use App\Model\Language\Entity\Language;
use Illuminate\Database\Query\JoinClause;

class CompanyRepository
{
    private Company $model;

    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function findBy(array $where, ?array $orderBy = [])
    {
        return $this->model->query()->orderBy('is_admin', 'desc')->get();
    }

    public function find(int $id)
    {
        return $this->model->query()->find($id);
    }

    public function findCompaniesByUser(int $userId){
        return $this->model->query()
            ->join('users_to_companies', 'users_to_companies.company_id',
                '=', 'companies.company_id')
            ->where('users_to_companies.user_id', '=', $userId)
            ->get();
    }

    public function findCustomerMainCompany(int $customerId){
        return $this->model->query()
            ->join('customers_to_companies', 'customers_to_companies.company_id',
                '=', 'companies.company_id')
            ->where('customers_to_companies.customer_id', '=', $customerId)
            ->where('customers_to_companies.is_main', '=', 1)->first();
    }

    public function getSimpleInfo(?int $languageId = null)
    {
        $languageId ??= Language::RU_ID;
        return $this->model->query()
            ->leftJoin('company_descriptions', function (JoinClause $join) {
                $join->on('companies.company_id', '=', 'company_descriptions.company_id');
            })
            ->where("company_descriptions.language_id", "=", $languageId)
            ->where("companies.is_admin", "=", 0)
            ->select(["companies.company_id as companyId", "company_descriptions.name"])->get()->toArray();
    }
}
