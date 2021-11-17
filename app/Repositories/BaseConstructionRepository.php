<?php


namespace App\Repositories;

use App\Support\Traits\GetAllWithFilters;
use Illuminate\Database\Eloquent\Model;
use Txsoura\Core\Helpers;
use Txsoura\Core\Repositories\Traits\QueryFilterRepository;

abstract class BaseConstructionRepository
{
    use Helpers, QueryFilterRepository, GetAllWithFilters;

    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = [];
    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array();
    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array();
    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array();
    /**
     * Allowed model columns to use in filter by date
     * @var array
     */
    protected $allow_between_dates = array();
    /**
     * Allowed model columns to use in filter by value
     * @var array
     */
    protected $allow_between_values = array();

    /**
     * @param int $id
     * @param int $constructionId
     * @return Model|null
     */
    public function find(int $id, int $constructionId): ?Model
    {
        return $this->model()::where('id', $id)
            ->where('construction_id', $constructionId)
            ->when($this->request, function ($query) {
                if (key_exists('include', $this->request))
                    $query->with(explode(',', $this->request['include']));

                return $query;
            })
            ->first();
    }

    /**
     * @param int $id
     * @param int $constructionId
     * @return Model|null
     */
    public function findOrFail(int $id, int $constructionId): ?Model
    {
        return $this->model()::where('id', $id)
            ->where('construction_id', $constructionId)
            ->when($this->request, function ($query) {
                if (key_exists('include', $this->request))
                    $query->with(explode(',', $this->request['include']));

                return $query;
            })
            ->firstOrFail();
    }

    /**
     * @param int $id
     * @param int $constructionId
     * @return Model|null
     */
    public function findOrFailWithTrashed(int $id, int $constructionId): ?Model
    {
        return $this->model()::withTrashed()
            ->where('id', $id)
            ->where('construction_id', $constructionId)
            ->when(key_exists('include', $this->request), function ($query) {
                if ($this->checkIncludeColumns()) {
                    $query->with(explode(',', $this->request['include']));
                }

                return $query;
            })
            ->firstOrFail();
    }

    /**
     * Model class instance.
     *
     * @return string
     */
    abstract protected function model(): string;
}
