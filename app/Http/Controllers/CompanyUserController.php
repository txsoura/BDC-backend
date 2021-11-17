<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyUserResource;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Repositories\CompanyUserRepository;
use App\Services\CompanyUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Txsoura\Core\Http\Controllers\Traits\CRUDMethodsController;
use Txsoura\Core\Http\Controllers\Traits\SoftDeleteMethodsController;

class CompanyUserController extends Controller
{
    use CRUDMethodsController, SoftDeleteMethodsController;

    /**
     * @var CompanyUserRepository
     */
    protected $repository;

    /**
     * @var CompanyUserService
     */
    protected $service;

    /**
     * CompanyUserController constructor.
     */
    public function __construct(CompanyUserService $service, CompanyUserRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Company $company
     * @return AnonymousResourceCollection
     */
    public function index(Request $request, Company $company): AnonymousResourceCollection
    {
        $request['company_id'] = $company->id;

        $users = $this->service
            ->setRequest($request)
            ->index();

        return CompanyUserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return CompanyUserResource|JsonResponse
     */
    public function store(Request $request, Company $company)
    {
        $request['company_id'] = $company->id;

        $user = $this->service
            ->setRequest($request)
            ->store();

        if (!$user) {
            return response()->json([
                'message' => trans('core::message.store_failed')
            ], 400);
        }

        return (new CompanyUserResource($user))
            ->additional(['message' => trans('core::message.stored')]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Company $company
     * @param CompanyUser $user
     * @return CompanyUserResource
     */
    public function show(Request $request, Company $company, CompanyUser $user): CompanyUserResource
    {
        $user = $this->service
            ->setRequest($request)
            ->show($user->id, $company->id);

        return new CompanyUserResource($user);
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Company $company
     * @param CompanyUser $user
     * @return CompanyUserResource|JsonResponse
     */
    public function update(Request $request, Company $company, CompanyUser $user): CompanyUserResource
    {
        $user = $this->service
            ->setRequest($request)
            ->update($user->id, $company->id);

        if (!$user) {
            return response()->json([
                'message' => trans('core::message.update_failed')
            ], 400);
        }

        return (new CompanyUserResource($user))
            ->additional(['message' => trans('core::message.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @param CompanyUser $user
     * @return JsonResponse
     */
    public function destroy(Company $company, CompanyUser $user): JsonResponse
    {
        if (!$this->service->destroy($user->id, $company->id)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @param int $user
     * @return JsonResponse
     */
    public function forceDestroy(Company $company, int $user): JsonResponse
    {
        if (!$this->service->forceDestroy($user, $company->id)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Company $company
     * @param int $user
     * @return JsonResponse
     */
    public function restore(Company $company, int $user): JsonResponse
    {
        if (!$this->service->restore($user, $company->id)) {
            return response()->json([
                'message' => trans('core::message.restore_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.restored')
        ]);
    }
}
