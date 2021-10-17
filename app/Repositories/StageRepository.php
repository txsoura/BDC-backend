<?php

namespace App\Repositories;

use App\Models\Stage;

class StageRepository extends BaseConstructionRepository
{
    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['construction'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('name', 'construction_id', 'budget');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('name', 'construction_id', 'budget', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array('name');

    /**
     * Allowed model columns to use in filter by date
     * @var array
     */
    protected $allow_between_dates = array('created_at', 'updated_at');

    /**
     * Allowed model columns to use in filter by value
     * @var array
     */
    protected $allow_between_values = array('budget');

    protected function model(): string
    {
        return Stage::class;
    }
}
