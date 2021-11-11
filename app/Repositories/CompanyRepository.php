<?php

namespace App\Repositories;

use App\Enums\CompanyStatus;
use App\Models\Company;
use Txsoura\Core\Repositories\CoreRepository;
use Txsoura\Core\Repositories\Traits\SoftDeleteMethodsRepository;

class CompanyRepository extends CoreRepository
{
    use SoftDeleteMethodsRepository;

    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['users', 'subscriptions'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('name', 'tax', 'type', 'workspace', 'cellphone', 'email', 'street', 'postcode', 'number', 'complement', 'city', 'state', 'country', 'district', 'status');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('name', 'tax', 'type', 'workspace', 'cellphone', 'email', 'street', 'postcode', 'number', 'complement', 'city', 'state', 'country', 'district', 'status', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array('name', 'tax', 'workspace', 'cellphone', 'email', 'street', 'postcode', 'number', 'complement', 'city', 'state', 'country', 'district');

    /**
     * Allowed model columns to use in filter by date
     * @var array
     */
    protected $allow_between_dates = array('created_at', 'updated_at');

    /**
     * Allowed model columns to use in filter by value
     * @var array
     */
    protected $allow_between_values = array();

    /**
     * @param Company $company
     * @return Company|null
     */
    public function approve(Company $company): ?Company
    {
        $company->status = CompanyStatus::APPROVED;
        $company->update();

        return $company;
    }

    /**
     * @param Company $company
     * @return Company|null
     */
    public function block(Company $company): ?Company
    {
        $company->status = CompanyStatus::BLOCKED;
        $company->update();

        return $company;
    }

    protected function model(): string
    {
        return Company::class;
    }
}
