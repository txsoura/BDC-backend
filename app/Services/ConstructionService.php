<?php

namespace App\Services;

use App\Http\Requests\ConstructionStoreRequest;
use App\Http\Requests\ConstructionUpdateRequest;
use App\Models\Construction;
use App\Repositories\ConstructionRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Txsoura\Core\Services\CoreService;
use Txsoura\Core\Services\Traits\CRUDMethodsService;
use Txsoura\Core\Services\Traits\SoftDeleteMethodsService;

class ConstructionService extends CoreService
{
    use CRUDMethodsService, SoftDeleteMethodsService;

    protected $storeRequest = ConstructionStoreRequest::class;
    protected $updateRequest = ConstructionUpdateRequest::class;

    /**
     * @var ConstructionRepository
     */
    protected $repository;

    /**
     * ConstructionService constructor.
     * @param ConstructionRepository $repository
     */
    public function __construct(ConstructionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Construction $construction
     * @return Construction|false
     */
    public function pause(Construction $construction)
    {
        try {
            return $this->repository->pause($construction);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Construction $construction
     * @return Construction|false
     */
    public function start(Construction $construction)
    {
        try {
            return $this->repository->start($construction);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Construction $construction
     * @return Construction|false
     */
    public function finalize(Construction $construction)
    {
        try {
            return $this->repository->finalize($construction);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Construction $construction
     * @return Construction|false
     */
    public function abandon(Construction $construction)
    {
        try {
            return $this->repository->abandon($construction);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Construction $construction
     * @return Construction|false
     */
    public function cancel(Construction $construction)
    {
        try {
            return $this->repository->cancel($construction);
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
        return Construction::class;
    }
}
