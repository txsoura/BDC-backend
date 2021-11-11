<?php

namespace App\Services;

use App\Http\Requests\CompanyUserStoreRequest;
use App\Http\Requests\CompanyUserUpdateRequest;
use App\Models\CompanyUser;
use App\Repositories\CompanyUserRepository;
use Exception;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Txsoura\Core\Helpers;
use Txsoura\Core\Http\Requests\QueryParamsRequest;

class CompanyUserService
{
    use Helpers;

    protected $queryParamsRequest = QueryParamsRequest::class;
    protected $storeRequest = CompanyUserStoreRequest::class;
    protected $updateRequest = CompanyUserUpdateRequest::class;

    /**
     * @var CompanyUserRepository
     */
    protected $repository;

    /**
     * CompanyUserService constructor.
     * @param CompanyUserRepository $repository
     */
    public function __construct(CompanyUserRepository $repository)
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
     * @return CompanyUser|false
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
     * @return CompanyUser|null
     */
    public function show(int $id, int $companyId): ?CompanyUser
    {
        $this->request = resolve($this->queryParamsRequest);

        return $this->repository->setRequest($this->request)->findOrFail($id, $companyId);
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return CompanyUser|false
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
}
