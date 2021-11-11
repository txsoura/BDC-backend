<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Support\Helpers\ActivityLog;

class SubscriptionObserver
{
    /**
     * Handle the Subscription "created" event.
     *
     * @param Subscription $subscription
     * @return void
     */
    public function created(Subscription $subscription)
    {
        ActivityLog::create('subscription_store', 'subscription_store_description', $subscription->getTable(), $subscription->id, request(), $subscription->toArray());
    }

    /**
     * Handle the Subscription "updated" event.
     *
     * @param Subscription $subscription
     * @return void
     */
    public function updated(Subscription $subscription)
    {
        ActivityLog::create('subscription_update', 'subscription_update_description', $subscription->getTable(), $subscription->id, request(), $subscription->getOriginal(), $subscription->getChanges());
    }

    /**
     * Handle the Subscription "deleted" event.
     *
     * @param Subscription $subscription
     * @return void
     */
    public function deleted(Subscription $subscription)
    {
        ActivityLog::create('subscription_destroy', 'subscription_destroy_description', $subscription->getTable(), $subscription->id, request());
    }

    /**
     * Handle the Subscription "restored" event.
     *
     * @param Subscription $subscription
     * @return void
     */
    public function restored(Subscription $subscription)
    {
        ActivityLog::create('subscription_restore', 'subscription_restore_description', $subscription->getTable(), $subscription->id, request());
    }

    /**
     * Handle the Subscription "force deleted" event.
     *
     * @param Subscription $subscription
     * @return void
     */
    public function forceDeleted(Subscription $subscription)
    {
        ActivityLog::create('subscription_force_destroy', 'subscription_force_destroy_description', $subscription->getTable(), $subscription->id, request());
    }
}
