<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Txsoura\Core\Http\Controllers\Traits\CRUDMethodsController;
use Txsoura\Core\Http\Controllers\Traits\SoftDeleteMethodsController;

class CompanyController extends Controller
{
    use CRUDMethodsController, SoftDeleteMethodsController;

    /**
     * @var CompanyRepository
     */
    protected $repository;

    /**
     * @var CompanyResource
     */
    protected $resource = CompanyResource::class;

    /**
     * @var CompanyService
     */
    protected $service;

    /**
     * CompanyController constructor.
     */
    public function __construct(CompanyService $service, CompanyRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Update the company status to approved.
     *
     * @param Company $company
     * @return JsonResponse|CompanyResource
     */
    public function approve(Company $company)
    {
        $company = $this->service
            ->approve($company);

        if (!$company) {
            return response()->json([
                'message' => trans('company.approve_failed')
            ], 400);
        }

        return (new CompanyResource($company))
            ->additional(['message' => trans('company.approved')]);
    }

    /**
     * Update the company status to blocked.
     *
     * @param Company $company
     * @return JsonResponse|CompanyResource
     */
    public function block(Company $company)
    {
        $company = $this->service
            ->block($company);

        if (!$company) {
            return response()->json([
                'message' => trans('company.block_failed')
            ], 400);
        }

        return (new CompanyResource($company))
            ->additional(['message' => trans('company.blocked')]);
    }
}
