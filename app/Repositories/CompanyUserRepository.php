<?php

namespace App\Repositories;

use App\Models\CompanyUser;
use App\Support\Traits\GetAllWithFilters;
use Txsoura\Core\Helpers;
use Txsoura\Core\Repositories\Traits\QueryFilterRepository;

class CompanyUserRepository
{
    use Helpers, QueryFilterRepository, GetAllWithFilters;

    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['user', 'company'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('role', 'user_id', 'company_id');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('role', 'user_id', 'company_id', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array();

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
     * @param int $id
     * @param int $companyId
     * @return CompanyUser|null
     */
    public function find(int $id, int $companyId): ?CompanyUser
    {
        return CompanyUser::whereCompanyId($companyId)
            ->whereId($id)
            ->when($this->request, function ($query) {
                if (key_exists('include', $this->request))
                    $query->with(explode(',', $this->request['include']));

                return $query;
            })
            ->first();
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return CompanyUser|null
     */
    public function findOrFail(int $id, int $companyId): ?CompanyUser
    {
        return CompanyUser::whereCompanyId($companyId)
            ->whereId($id)
            ->when($this->request, function ($query) {
                if (key_exists('include', $this->request))
                    $query->with(explode(',', $this->request['include']));

                return $query;
            })
            ->firstOrFail();
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return CompanyUser|null
     */
    public function findOrFailWithTrashed(int $id, int $companyId): ?CompanyUser
    {
        return CompanyUser::withTrashed()
            ->whereCompanyId($companyId)
            ->whereId($id)
            ->when(key_exists('include', $this->request), function ($query) {
                if ($this->checkIncludeColumns()) {
                    $query->with(explode(',', $this->request['include']));
                }

                return $query;
            })
            ->firstOrFail();
    }

    protected function model(): string
    {
        return CompanyUser::class;
    }
}
