<?php

namespace App\Repositories;

use App\Enums\StockStatus;
use App\Models\Stock;
use App\Support\Traits\GetAllWithFilters;
use Illuminate\Database\Eloquent\Model;
use Txsoura\Core\Helpers;
use Txsoura\Core\Repositories\Traits\QueryFilterRepository;

class StockRepository
{
    use Helpers, QueryFilterRepository, GetAllWithFilters;

    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['construction', 'provider', 'product'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('quantity', 'price', 'construction_id', 'provider_id', 'product_id', 'flow', 'status');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('quantity', 'price', 'construction_id', 'provider_id', 'product_id', 'flow', 'status', 'outgoing_at', 'canceled_at', 'arrived_at', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array('outgoing_receiver');

    /**
     * Allowed model columns to use in filter by date
     * @var array
     */
    protected $allow_between_dates = array('outgoing_at', 'canceled_at', 'arrived_at', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in filter by value
     * @var array
     */
    protected $allow_between_values = array('quantity', 'price');

    /**
     * @param int $id
     * @param int $construction_id
     * @param int $product_id
     * @return Model|null
     */
    public function find(int $id, int $construction_id, int $product_id): ?Model
    {
        return Stock::whereId($id)
            ->whereConstructionId($construction_id)
            ->whereProductId($product_id)
            ->when($this->request, function ($query) {
                if (key_exists('include', $this->request))
                    return $query->with(explode(',', $this->request['include']));
            })
            ->first();
    }

    /**
     * @param int $id
     * @param int $construction_id
     * @param int $product_id
     * @return Model|null
     */
    public function findOrFail(int $id, int $construction_id, int $product_id): ?Model
    {
        return Stock::whereId($id)
            ->whereConstructionId($construction_id)
            ->whereProductId($product_id)
            ->when($this->request, function ($query) {
                if (key_exists('include', $this->request))
                    return $query->with(explode(',', $this->request['include']));
            })
            ->firstOrFail();
    }

    /**
     * @param Stock $stock
     * @return Stock|null
     */
    public function arrive(Stock $stock): ?Stock
    {
        $stock->status = StockStatus::ARRIVED;
        $stock->arrived_at = now();
        $stock->update();

        return $stock;
    }

    /**
     * @param Stock $stock
     * @return Stock|null
     */
    public function cancel(Stock $stock): ?Stock
    {
        $stock->status = StockStatus::CANCELED;
        $stock->canceled_at = now();
        $stock->update();

        return $stock;
    }

    /**
     * @param Stock $stock
     * @param string $receiver
     * @return Stock|null
     */
    public function outgoing(Stock $stock, string $receiver): ?Stock
    {
        $stock->status = StockStatus::OUTGOING;
        $stock->outgoing_receiver = $receiver;
        $stock->outgoing_at = now();
        $stock->update();

        return $stock;
    }

    protected function model(): string
    {
        return Stock::class;
    }
}
