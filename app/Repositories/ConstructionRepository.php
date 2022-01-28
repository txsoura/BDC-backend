<?php

namespace App\Repositories;

use App\Enums\ConstructionStatus;
use App\Models\Construction;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Txsoura\Core\Helpers;
use Txsoura\Core\Repositories\Traits\QueryFilterRepository;

class ConstructionRepository
{
    use Helpers, QueryFilterRepository;

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
     * Get all model data, with filters if required
     *
     * @return Collection|Paginator
     */
    public function all()
    {
        $this->setParams($this->checkWhereColumns());

        $models = Construction::when(key_exists('onlyTrashed', $this->request), function ($query) {
            if ($this->request['onlyTrashed'])
                $query->onlyTrashed();
        })
            ->when(key_exists('withTrashed', $this->request), function ($query) {
                if ($this->request['withTrashed'])
                    $query->withTrashed();

                return $query;
            })
            ->whereCompanyId($this->request['company_id'])
            ->whereHas('users.companyUser', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->when(key_exists('date_column', $this->request), function ($query) {
                if ($this->checkDateColumns()) {
                    if (key_exists('date_start', $this->request))
                        $query->where($this->request['date_column'], '>=', $this->request['date_start']);
                    if (key_exists('date_end', $this->request))
                        $query->where($this->request['date_column'], '<=', $this->request['date_end']);
                }

                return $query;
            })
            ->when(key_exists('value_column', $this->request), function ($query) {
                if ($this->checkValueColumns()) {
                    if (key_exists('value_min', $this->request))
                        $query->where($this->request['value_column'], '>=', $this->request['value_min']);
                    if (key_exists('value_max', $this->request))
                        $query->where($this->request['value_column'], '<=', $this->request['value_max']);
                }

                return $query;
            })
            ->when(key_exists('q', $this->request), function ($query) {
                if ($this->checkQueryColumns()) {
                    foreach ($this->allow_like as $column) {
                        $query->orWhere($column, 'like', '%' . $this->request['q'] . '%');
                    }
                }

                return $query;
            })
            ->when($this->params, function ($query) {
                foreach (array_keys($this->params) as $column) {
                    $query->where($column, $this->params[$column]);
                }

                return $query;
            })
            ->when(key_exists('sort', $this->request), function ($query) {
                $columns = explode(',', $this->request['sort']);

                if ($this->checkSortColumns($columns)) {
                    foreach ($columns as $column) {
                        if (Str::contains($column, '-')) {
                            $query->orderBy(substr($column, 1), 'desc');
                        } else {
                            $query->orderBy($column, 'asc');
                        }
                    }
                }

                return $query;
            })
            ->when(key_exists('take', $this->request), function ($query) {
                return $query->limit($this->request['take']);
            })
            ->when(key_exists('include', $this->request), function ($query) {
                if ($this->checkIncludeColumns()) {
                    $query->with(explode(',', $this->request['include']));
                }

                return $query;
            });

        if (key_exists('paginate', $this->request)) {
            return $models->paginate($this->request['paginate']);
        } else {
            return $models->get();
        }
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return Construction|null
     */
    public function find(int $id, int $companyId): ?Construction
    {
        return Construction::whereCompanyId($companyId)
            ->whereId($id)
            ->whereHas('users.companyUser', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
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
            ->whereHas('users.companyUser', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
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
