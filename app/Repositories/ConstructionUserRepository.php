<?php

namespace App\Repositories;

use App\Models\ConstructionUser;

class ConstructionUserRepository extends BaseConstructionRepository
{
    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['construction', 'user'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('role', 'user_id', 'construction_id');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('role', 'user_id', 'construction_id', 'created_at', 'updated_at');

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

    protected function model(): string
    {
        return ConstructionUser::class;
    }
}