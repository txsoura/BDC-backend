<?php

namespace App\Observers;

use App\Models\Stage;
use App\Support\Helpers\ActivityLog;

class StageObserver
{
    /**
     * Handle the Stage "created" event.
     *
     * @param Stage $stage
     * @return void
     */
    public function created(Stage $stage)
    {
        ActivityLog::create('stage_store', 'stage_store_description', $stage->getTable(), $stage->id, request(), $stage->toArray());
    }

    /**
     * Handle the Stage "updated" event.
     *
     * @param Stage $stage
     * @return void
     */
    public function updated(Stage $stage)
    {
        ActivityLog::create('stage_update', 'stage_update_description', $stage->getTable(), $stage->id, request(), $stage->getOriginal(), $stage->getChanges());
    }

    /**
     * Handle the Stage "deleted" event.
     *
     * @param Stage $stage
     * @return void
     */
    public function deleted(Stage $stage)
    {
        ActivityLog::create('stage_destroy', 'stage_destroy_description', $stage->getTable(), $stage->id, request());
    }

    /**
     * Handle the Stage "restored" event.
     *
     * @param Stage $stage
     * @return void
     */
    public function restored(Stage $stage)
    {
        ActivityLog::create('stage_restore', 'stage_restore_description', $stage->getTable(), $stage->id, request());
    }

    /**
     * Handle the Stage "force deleted" event.
     *
     * @param Stage $stage
     * @return void
     */
    public function forceDeleted(Stage $stage)
    {
        ActivityLog::create('stage_force_destroy', 'stage_force_destroy_description', $stage->getTable(), $stage->id, request());
    }
}
