<?php

namespace App\Observers;

use App\Models\CompanyUser;
use App\Support\Helpers\ActivityLog;

class CompanyUserObserver
{
    /**
     * Handle the CompanyUser "created" event.
     *
     * @param CompanyUser $companyUser
     * @return void
     */
    public function created(CompanyUser $companyUser)
    {
        ActivityLog::create('company_user_store', 'company_user_store_description', $companyUser->getTable(), $companyUser->id, request(), $companyUser->toArray());
    }

    /**
     * Handle the CompanyUser "updated" event.
     *
     * @param CompanyUser $companyUser
     * @return void
     */
    public function updated(CompanyUser $companyUser)
    {
        ActivityLog::create('company_user_update', 'company_user_update_description', $companyUser->getTable(), $companyUser->id, request(), $companyUser->getOriginal(), $companyUser->getChanges());
    }

    /**
     * Handle the CompanyUser "deleted" event.
     *
     * @param CompanyUser $companyUser
     * @return void
     */
    public function deleted(CompanyUser $companyUser)
    {
        ActivityLog::create('company_user_destroy', 'company_user_destroy_description', $companyUser->getTable(), $companyUser->id, request());
    }

    /**
     * Handle the CompanyUser "restored" event.
     *
     * @param CompanyUser $companyUser
     * @return void
     */
    public function restored(CompanyUser $companyUser)
    {
        ActivityLog::create('company_user_restore', 'company_user_restore_description', $companyUser->getTable(), $companyUser->id, request());
    }

    /**
     * Handle the CompanyUser "force deleted" event.
     *
     * @param CompanyUser $companyUser
     * @return void
     */
    public function forceDeleted(CompanyUser $companyUser)
    {
        ActivityLog::create('company_user_force_destroy', 'company_user_force_destroy_description', $companyUser->getTable(), $companyUser->id, request());
    }
}
