<?php

namespace App\Repositories;

use App\Enums\ConstructionStatus;
use App\Models\Construction;
use App\Support\Traits\GetAllWithFilters;
use Txsoura\Core\Helpers;
use Txsoura\Core\Repositories\Traits\QueryFilterRepository;

class ConstructionRepository
{
    use Helpers, QueryFilterRepository, GetAllWithFilters;

    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['company', 'users', 'stages', 'inspections', 'stocks', 'providers', 'products'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('name', 'start_date', 'end_date', 'status', 'budget', 'company_id');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('name', 'start_date', 'end_date', 'status', 'budget', 'canceled_at', 'started_at', 'finalized_at', 'abandoned_at', 'company_id', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array('name');

    /**
     * Allowed model columns to use in filter by date
     * @var array
     */
    protected $allow_between_dates = array('start_date', 'end_date', 'canceled_at', 'started_at', 'finalized_at', 'abandoned_at', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in filter by value
     * @var array
     */
    protected $allow_between_values = array('budget');

    /**
     * @param int $id
     * @param int $companyId
     * @return Construction|null
     */
    public function find(int $id, int $companyId): ?Construction
    {
        return Construction::whereCompanyId($companyId)
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
     * @return Construction|null
     */
    public function findOrFail(int $id, int $companyId): ?Construction
    {
        return Construction::whereCompanyId($companyId)
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
     * @return Construction|null
     */
    public function findOrFailWithTrashed(int $id, int $companyId): ?Construction
    {
        return Construction::withTrashed()
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

    /**
     * @param Construction $construction
     * @return Construction|null
     */
    public function pause(Construction $construction): ?Construction
    {
        $construction->status = ConstructionStatus::PAUSED;
        $construction->update();

        return $construction;
    }

    /**
     * @param Construction $construction
     * @return Construction|null
     */
    public function start(Construction $construction): ?Construction
    {
        $construction->status = ConstructionStatus::STARTED;
        $construction->started_at = now();
        $construction->update();

        return $construction;
    }

    /**
     * @param Construction $construction
     * @return Construction|null
     */
    public function finalize(Construction $construction): ?Construction
    {
        $construction->status = ConstructionStatus::FINALIZED;
        $construction->finalized_at = now();
        $construction->update();

        return $construction;
    }

    /**
     * @param Construction $construction
     * @return Construction|null
     */
    public function abandon(Construction $construction): ?Construction
    {
        $construction->status = ConstructionStatus::ABANDONED;
        $construction->abandoned_at = now();
        $construction->update();

        return $construction;
    }

    /**
     * @param Construction $construction
     * @return Construction|null
     */
    public function cancel(Construction $construction): ?Construction
    {
        $construction->status = ConstructionStatus::CANCELED;
        $construction->canceled_at = now();
        $construction->update();

        return $construction;
    }

    protected function model(): string
    {
        return Construction::class;
    }
}
