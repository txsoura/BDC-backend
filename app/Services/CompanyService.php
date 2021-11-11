<?php

namespace App\Services;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Txsoura\Core\Services\CoreService;
use Txsoura\Core\Services\Traits\CRUDMethodsService;
use Txsoura\Core\Services\Traits\SoftDeleteMethodsService;

class CompanyService extends CoreService
{
    use CRUDMethodsService, SoftDeleteMethodsService;

    protected $storeRequest = CompanyStoreRequest::class;
    protected $updateRequest = CompanyUpdateRequest::class;

    /**
     * @var CompanyRepository
     */
    protected $repository;

    /**
     * CompanyService constructor.
     * @param CompanyRepository $repository
     */
    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Company $company
     * @return Company |false
     */
    public function approve(Company $company)
    {
        try {
            return $this->repository->approve($company);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Company $company
     * @return Company |false
     */
    public function block(Company $company)
    {
        try {
            return $this->repository->block($company);
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
        return Company::class;
    }
}
