<?php

namespace App\Observers;

use App\Models\Inspection;
use App\Support\Helpers\ActivityLog;

class InspectionObserver
{
    /**
     * Handle the Inspection "created" event.
     *
     * @param Inspection $inspection
     * @return void
     */
    public function created(Inspection $inspection)
    {
        ActivityLog::create('inspection_store', 'inspection_store_description', $inspection->getTable(), $inspection->id, request(), $inspection->toArray());
    }

    /**
     * Handle the Inspection "updated" event.
     *
     * @param Inspection $inspection
     * @return void
     */
    public function updated(Inspection $inspection)
    {
        ActivityLog::create('inspection_update', 'inspection_update_description', $inspection->getTable(), $inspection->id, request(), $inspection->getOriginal(), $inspection->getChanges());
    }

    /**
     * Handle the Inspection "deleted" event.
     *
     * @param Inspection $inspection
     * @return void
     */
    public function deleted(Inspection $inspection)
    {
        ActivityLog::create('inspection_destroy', 'inspection_destroy_description', $inspection->getTable(), $inspection->id, request());
    }

    /**
     * Handle the Inspection "restored" event.
     *
     * @param Inspection $inspection
     * @return void
     */
    public function restored(Inspection $inspection)
    {
        ActivityLog::create('inspection_restore', 'inspection_restore_description', $inspection->getTable(), $inspection->id, request());
    }

    /**
     * Handle the Inspection "force deleted" event.
     *
     * @param Inspection $inspection
     * @return void
     */
    public function forceDeleted(Inspection $inspection)
    {
        ActivityLog::create('inspection_force_destroy', 'inspection_force_destroy_description', $inspection->getTable(), $inspection->id, request());
    }
}
