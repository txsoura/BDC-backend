<?php

namespace App\Observers;

use App\Models\User;
use App\Support\Helpers\ActivityLog;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        ActivityLog::create('user_store', 'user_store_description', $user->getTable(), $user->id, request(), $user->toArray());
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        ActivityLog::create('user_update', 'user_update_description', $user->getTable(), $user->id, request(), $user->getOriginal(), $user->getChanges());
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        ActivityLog::create('user_destroy', 'user_destroy_description', $user->getTable(), $user->id, request());
    }

    /**
     * Handle the User "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {
        ActivityLog::create('user_restore', 'user_restore_description', $user->getTable(), $user->id, request());
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        ActivityLog::create('user_force_destroy', 'user_force_destroy_description', $user->getTable(), $user->id, request());
    }
}
