<?php

namespace App\Services;

use App\Http\Requests\StockStoreRequest;
use App\Models\Stock;
use App\Repositories\StockRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Txsoura\Core\Http\Requests\QueryParamsRequest;
use Txsoura\Core\Services\CoreService;

class StockService extends CoreService
{

    protected $queryParamsRequest = QueryParamsRequest::class;
    protected $storeRequest = StockStoreRequest::class;

    /**
     * @var StockRepository
     */
    protected $repository;

    /**
     * StockService constructor.
     * @param StockRepository $repository
     */
    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Paginator|Collection
     */
    public function index()
    {
        $this->request = resolve($this->queryParamsRequest);

        return $this->repository->setRequest($this->request)->all();
    }

    public function store()
    {
        $this->request = resolve($this->storeRequest);

        try {
            return Stock::create($this->request->validated());
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @param int $constructionId
     * @param int $productId
     * @return Model
     */
    public function show(int $id, int $constructionId, int $productId): Model
    {
        $this->request = resolve($this->queryParamsRequest);

        return $this->repository->setRequest($this->request)->findOrFail($id, $constructionId, $productId);
    }


    /**
     * @param int $id
     * @param int $constructionId
     * @param int $productId
     * @return bool
     */
    public function destroy(int $id, int $constructionId, int $productId): bool
    {
        $model = $this->repository->findOrFail($id, $constructionId, $productId);

        try {
            $model->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @param int $constructionId
     * @param int $productId
     * @return bool
     */
    public function forceDestroy(int $id, int $constructionId, int $productId): bool
    {
        $model = $this->repository->findOrFailWithTrashed($id, $constructionId, $productId);

        try {
            $model->forceDelete();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @param int $constructionId
     * @param int $productId
     * @return bool
     */
    public function restore(int $id, int $constructionId, int $productId): bool
    {
        $model = $this->repository->findOrFailWithTrashed($id, $constructionId, $productId);

        try {
            $model->restore();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Stock $stock
     * @return Stock|false
     */
    public function receive(Stock $stock)
    {
        try {
            return $this->repository->receive($stock);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Stock $stock
     * @return Stock|false
     */
    public function cancel(Stock $stock)
    {
        try {
            return $this->repository->cancel($stock);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Stock $stock
     * @param string $receiver
     * @return Stock|false
     */
    public function withdraw(Stock $stock, string $receiver)
    {
        try {
            return $this->repository->withdraw($stock, $receiver);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * Model class for crud.
     *
     * @return string
     */
    protected function model(): string
    {
        return Stock::class;
    }
}
