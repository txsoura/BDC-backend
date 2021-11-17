<?php

namespace App\Repositories;

use App\Models\Inspection;

class InspectionRepository extends BaseConstructionRepository
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
    protected $allow_where = array('construction_id');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('construction_id', 'seem', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array('seem');

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

    protected function model(): string
    {
        return Inspection::class;
    }
}
