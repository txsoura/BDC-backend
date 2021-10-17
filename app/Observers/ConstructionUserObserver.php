<?php

namespace App\Observers;

use App\Models\ConstructionUser;
use App\Support\Helpers\ActivityLog;

class ConstructionUserObserver
{
    /**
     * Handle the ConstructionUser "created" event.
     *
     * @param ConstructionUser $constructionUser
     * @return void
     */
    public function created(ConstructionUser $constructionUser)
    {
        ActivityLog::create('construction_user_store', 'construction_user_store_description', $constructionUser->getTable(), $constructionUser->id, request(), $constructionUser->toArray());
    }

    /**
     * Handle the ConstructionUser "updated" event.
     *
     * @param ConstructionUser $constructionUser
     * @return void
     */
    public function updated(ConstructionUser $constructionUser)
    {
        ActivityLog::create('construction_user_update', 'construction_user_update_description', $constructionUser->getTable(), $constructionUser->id, request(), $constructionUser->getOriginal(), $constructionUser->getChanges());
    }

    /**
     * Handle the ConstructionUser "deleted" event.
     *
     * @param ConstructionUser $constructionUser
     * @return void
     */
    public function deleted(ConstructionUser $constructionUser)
    {
        ActivityLog::create('construction_user_destroy', 'construction_user_destroy_description', $constructionUser->getTable(), $constructionUser->id, request());
    }

    /**
     * Handle the ConstructionUser "restored" event.
     *
     * @param ConstructionUser $constructionUser
     * @return void
     */
    public function restored(ConstructionUser $constructionUser)
    {
        ActivityLog::create('construction_user_restore', 'construction_user_restore_description', $constructionUser->getTable(), $constructionUser->id, request());
    }

    /**
     * Handle the ConstructionUser "force deleted" event.
     *
     * @param ConstructionUser $constructionUser
     * @return void
     */
    public function forceDeleted(ConstructionUser $constructionUser)
    {
        ActivityLog::create('construction_user_force_destroy', 'construction_user_force_destroy_description', $constructionUser->getTable(), $constructionUser->id, request());
    }
}
