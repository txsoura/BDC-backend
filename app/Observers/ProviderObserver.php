<?php

namespace App\Observers;

use App\Models\Provider;
use App\Support\Helpers\ActivityLog;

class ProviderObserver
{
    /**
     * Handle the Provider "created" event.
     *
     * @param Provider $provider
     * @return void
     */
    public function created(Provider $provider)
    {
        ActivityLog::create('provider_store', 'provider_store_description', $provider->getTable(), $provider->id, request(), $provider->toArray());
    }

    /**
     * Handle the Provider "updated" event.
     *
     * @param Provider $provider
     * @return void
     */
    public function updated(Provider $provider)
    {
        ActivityLog::create('provider_update', 'provider_update_description', $provider->getTable(), $provider->id, request(), $provider->getOriginal(), $provider->getChanges());
    }

    /**
     * Handle the Provider "deleted" event.
     *
     * @param Provider $provider
     * @return void
     */
    public function deleted(Provider $provider)
    {
        ActivityLog::create('provider_destroy', 'provider_destroy_description', $provider->getTable(), $provider->id, request());
    }

    /**
     * Handle the Provider "restored" event.
     *
     * @param Provider $provider
     * @return void
     */
    public function restored(Provider $provider)
    {
        ActivityLog::create('provider_restore', 'provider_restore_description', $provider->getTable(), $provider->id, request());
    }

    /**
     * Handle the Provider "force deleted" event.
     *
     * @param Provider $provider
     * @return void
     */
    public function forceDeleted(Provider $provider)
    {
        ActivityLog::create('provider_force_destroy', 'provider_force_destroy_description', $provider->getTable(), $provider->id, request());
    }
}
