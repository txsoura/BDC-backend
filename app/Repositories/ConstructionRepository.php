<?php

namespace App\Repositories;

use App\Enums\ConstructionStatus;
use App\Models\Construction;
use Txsoura\Core\Repositories\CoreRepository;

class ConstructionRepository extends CoreRepository
{
    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['users', 'stages', 'inspections', 'stocks', 'products', 'providers'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('name', 'start_date', 'end_date', 'status', 'budget');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('name', 'start_date', 'end_date', 'status', 'budget', 'canceled_at', 'started_at', 'finalized_at', 'abandoned_at', 'created_at', 'updated_at');

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
