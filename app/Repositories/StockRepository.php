<?php

namespace App\Repositories;

use App\Enums\StockStatus;
use App\Models\Stock;
use App\Support\Traits\GetAllWithFilters;
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
    protected $allow_order = array('quantity', 'price', 'construction_id', 'provider_id', 'product_id', 'flow', 'status', 'withdrawn_at', 'canceled_at', 'received_at', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array('outgoing_receiver');

    /**
     * Allowed model columns to use in filter by date
     * @var array
     */
    protected $allow_between_dates = array('withdrawn_at', 'canceled_at', 'received_at', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in filter by value
     * @var array
     */
    protected $allow_between_values = array('quantity', 'price');

    /**
     * @param int $id
     * @param int $constructionId
     * @param int $productId
     * @return Stock|null
     */
    public function find(int $id, int $constructionId, int $productId): ?Stock
    {
        return Stock::whereId($id)
            ->whereConstructionId($constructionId)
            ->whereProductId($productId)
            ->when($this->request, function ($query) {
                if (key_exists('include', $this->request))
                    $query->with(explode(',', $this->request['include']));

                return $query;
            })
            ->first();
    }

    /**
     * @param int $id
     * @param int $constructionId
     * @param int $productId
     * @return Stock|null
     */
    public function findOrFail(int $id, int $constructionId, int $productId): ?Stock
    {
        return Stock::whereId($id)
            ->whereConstructionId($constructionId)
            ->whereProductId($productId)
            ->when($this->request, function ($query) {
                if (key_exists('include', $this->request))
                    $query->with(explode(',', $this->request['include']));

                return $query;
            })
            ->firstOrFail();
    }

    /**
     * @param int $id
     * @param int $constructionId
     * @param int $productId
     * @return Stock|null
     */
    public function findOrFailWithTrashed(int $id, int $constructionId, int $productId): ?Stock
    {
        return Stock::withTrashed()
            ->whereId($id)
            ->whereConstructionId($constructionId)
            ->whereProductId($productId)
            ->when(key_exists('include', $this->request), function ($query) {
                if ($this->checkIncludeColumns()) {
                    $query->with(explode(',', $this->request['include']));
                }

                return $query;
            })
            ->firstOrFail();
    }

    /**
     * @param Stock $stock
     * @return Stock|null
     */
    public function receive(Stock $stock): ?Stock
    {
        $stock->status = StockStatus::RECEIVED;
        $stock->received_at = now();
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
    public function withdraw(Stock $stock, string $receiver): ?Stock
    {
        $stock->status = StockStatus::WITHDRAWN;
        $stock->outgoing_receiver = $receiver;
        $stock->withdrawn_at = now();
        $stock->update();

        return $stock;
    }

    protected function model(): string
    {
        return Stock::class;
    }
}
