<?php

namespace App\Observers;

use App\Models\Construction;
use App\Support\Helpers\ActivityLog;

class ConstructionObserver
{
    /**
     * Handle the Construction "created" event.
     *
     * @param Construction $construction
     * @return void
     */
    public function created(Construction $construction)
    {
        ActivityLog::create('construction_store', 'construction_store_description', $construction->getTable(), $construction->id, request(), $construction->toArray());
    }

    /**
     * Handle the Construction "updated" event.
     *
     * @param Construction $construction
     * @return void
     */
    public function updated(Construction $construction)
    {
        ActivityLog::create('construction_update', 'construction_update_description', $construction->getTable(), $construction->id, request(), $construction->getOriginal(), $construction->getChanges());
    }

    /**
     * Handle the Construction "deleted" event.
     *
     * @param Construction $construction
     * @return void
     */
    public function deleted(Construction $construction)
    {
        ActivityLog::create('construction_destroy', 'construction_destroy_description', $construction->getTable(), $construction->id, request());
    }

    /**
     * Handle the Construction "restored" event.
     *
     * @param Construction $construction
     * @return void
     */
    public function restored(Construction $construction)
    {
        ActivityLog::create('construction_restore', 'construction_restore_description', $construction->getTable(), $construction->id, request());
    }

    /**
     * Handle the Construction "force deleted" event.
     *
     * @param Construction $construction
     * @return void
     */
    public function forceDeleted(Construction $construction)
    {
        ActivityLog::create('construction_force_destroy', 'construction_force_destroy_description', $construction->getTable(), $construction->id, request());
    }
}
