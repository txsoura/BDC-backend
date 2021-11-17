<?php

namespace App\Observers;

use App\Models\Stock;
use App\Support\Helpers\ActivityLog;

class StockObserver
{
    /**
     * Handle the Stock "created" event.
     *
     * @param Stock $stock
     * @return void
     */
    public function created(Stock $stock)
    {
        ActivityLog::create('stock_store', 'stock_store_description', $stock->getTable(), $stock->id, request(), $stock->toArray());
    }

    /**
     * Handle the Stock "updated" event.
     *
     * @param Stock $stock
     * @return void
     */
    public function updated(Stock $stock)
    {
        ActivityLog::create('stock_update', 'stock_update_description', $stock->getTable(), $stock->id, request(), $stock->getOriginal(), $stock->getChanges());
    }

    /**
     * Handle the Stock "deleted" event.
     *
     * @param Stock $stock
     * @return void
     */
    public function deleted(Stock $stock)
    {
        ActivityLog::create('stock_destroy', 'stock_destroy_description', $stock->getTable(), $stock->id, request());
    }

    /**
     * Handle the Stock "restored" event.
     *
     * @param Stock $stock
     * @return void
     */
    public function restored(Stock $stock)
    {
        ActivityLog::create('stock_restore', 'stock_restore_description', $stock->getTable(), $stock->id, request());
    }

    /**
     * Handle the Stock "force deleted" event.
     *
     * @param Stock $stock
     * @return void
     */
    public function forceDeleted(Stock $stock)
    {
        ActivityLog::create('stock_force_destroy', 'stock_force_destroy_description', $stock->getTable(), $stock->id, request());
    }
}
