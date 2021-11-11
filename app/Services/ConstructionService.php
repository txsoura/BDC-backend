<?php

namespace App\Services;

use App\Http\Requests\ConstructionStoreRequest;
use App\Http\Requests\ConstructionUpdateRequest;
use App\Models\CompanyUser;
use App\Models\Construction;
use App\Repositories\ConstructionRepository;
use Exception;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Txsoura\Core\Helpers;
use Txsoura\Core\Http\Requests\QueryParamsRequest;

class ConstructionService
{
    use Helpers;

    protected $queryParamsRequest = QueryParamsRequest::class;
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
     * @return Collection|Paginator
     */
    public function index()
    {
        $this->request = resolve($this->queryParamsRequest);

        return $this->repository->setRequest($this->request)->all();
    }

    /**
     * @return Construction|false
     */
    public function store()
    {
        $this->request = resolve($this->storeRequest);

        try {
            return CompanyUser::create($this->request->validated());
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return Construction|null
     */
    public function show(int $id, int $companyId): ?Construction
    {
        $this->request = resolve($this->queryParamsRequest);

        return $this->repository->setRequest($this->request)->findOrFail($id, $companyId);
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return Construction|false
     */
    public function update(int $id, int $companyId)
    {
        $this->request = resolve($this->updateRequest);

        $companyUser = $this->repository->findOrFail($id, $companyId);

        try {
            $companyUser->update($this->request->validated());

            return $companyUser;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return bool
     */
    public function destroy(int $id, int $companyId): bool
    {
        $companyUser = $this->repository->findOrFail($id, $companyId);

        try {
            $companyUser->delete();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return bool
     */
    public function forceDestroy(int $id, int $companyId): bool
    {
        $companyUser = $this->repository->findOrFailWithTrashed($id, $companyId);

        try {
            $companyUser->forceDelete();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return bool
     */
    public function restore(int $id, int $companyId): bool
    {
        $companyUser = $this->repository->findOrFailWithTrashed($id, $companyId);

        try {
            $companyUser->restore();

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
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
