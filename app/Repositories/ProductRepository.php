<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseConstructionRepository
{
    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['construction', 'stocks'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('name', 'type', 'notify_when_stock_below', 'available', 'construction_id');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('name', 'type', 'notify_when_stock_below', 'available', 'construction_id', 'created_at', 'updated_at');

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
    protected $allow_between_values = array('available');

    protected function model(): string
    {
        return Product::class;
    }
}
