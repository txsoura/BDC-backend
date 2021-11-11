<?php

namespace App\Observers;

use App\Models\Company;
use App\Support\Helpers\ActivityLog;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param Company $company
     * @return void
     */
    public function created(Company $company)
    {
        ActivityLog::create('company_store', 'company_store_description', $company->getTable(), $company->id, request(), $company->toArray());
    }

    /**
     * Handle the Company "updated" event.
     *
     * @param Company $company
     * @return void
     */
    public function updated(Company $company)
    {
        ActivityLog::create('company_update', 'company_update_description', $company->getTable(), $company->id, request(), $company->getOriginal(), $company->getChanges());
    }

    /**
     * Handle the Company "deleted" event.
     *
     * @param Company $company
     * @return void
     */
    public function deleted(Company $company)
    {
        ActivityLog::create('company_destroy', 'company_destroy_description', $company->getTable(), $company->id, request());
    }

    /**
     * Handle the Company "restored" event.
     *
     * @param Company $company
     * @return void
     */
    public function restored(Company $company)
    {
        ActivityLog::create('company_restore', 'company_restore_description', $company->getTable(), $company->id, request());
    }

    /**
     * Handle the Company "force deleted" event.
     *
     * @param Company $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        ActivityLog::create('company_force_destroy', 'company_force_destroy_description', $company->getTable(), $company->id, request());
    }
}
