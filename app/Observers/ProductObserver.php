<?php

namespace App\Observers;

use App\Models\Product;
use App\Support\Helpers\ActivityLog;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param Product $product
     * @return void
     */
    public function created(Product $product)
    {
        ActivityLog::create('product_store', 'product_store_description', $product->getTable(), $product->id, request(), $product->toArray());
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        ActivityLog::create('product_update', 'product_update_description', $product->getTable(), $product->id, request(), $product->getOriginal(), $product->getChanges());
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        ActivityLog::create('product_destroy', 'product_destroy_description', $product->getTable(), $product->id, request());
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        ActivityLog::create('product_restore', 'product_restore_description', $product->getTable(), $product->id, request());
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        ActivityLog::create('product_force_destroy', 'product_force_destroy_description', $product->getTable(), $product->id, request());
    }
}
