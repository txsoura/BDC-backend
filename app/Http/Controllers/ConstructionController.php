<?php

namespace App\Http\Controllers;

use App\Enums\ConstructionStatus;
use App\Http\Resources\ConstructionResource;
use App\Models\Construction;
use App\Repositories\ConstructionRepository;
use App\Services\ConstructionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Txsoura\Core\Http\Controllers\Traits\CRUDMethodsController;
use Txsoura\Core\Http\Controllers\Traits\SoftDeleteMethodsController;

class ConstructionController extends Controller
{
    use CRUDMethodsController, SoftDeleteMethodsController;

    /**
     * @var int
     */
    protected $companyId;

    /**
     * @var ConstructionRepository
     */
    protected $repository;

    /**
     * @var ConstructionService
     */
    protected $service;

    /**
     * ConstructionController constructor.
     */
    public function __construct(Request $request, ConstructionService $service, ConstructionRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
        $this->companyId = (int)$request->header('X-Company');
    }

    public function index(Request $request)
    {
        $request['company_id'] = $this->companyId;

        $constructions = $this->service
            ->setRequest($request)
            ->index();

        return ConstructionResource::collection($constructions);
    }

    public function store(Request $request, Construction $construction)
    {
        $request['company_id'] = $this->companyId;

        $construction = $this->service
            ->setRequest($request)
            ->store();

        if (!$construction) {
            return response()->json([
                'message' => trans('core::message.store_failed')
            ], 400);
        }

        return (new ConstructionResource($construction))
            ->additional(['message' => trans('core::message.stored')]);
    }

    public function show(Request $request, Construction $construction)
    {
        $construction = $this->service
            ->setRequest($request)
            ->show($construction->id, $this->companyId);

        return new ConstructionResource($construction);
    }

    public function update(Request $request, Construction $construction)
    {
        $construction = $this->service
            ->setRequest($request)
            ->update($construction->id, $this->companyId);

        if (!$construction) {
            return response()->json([
                'message' => trans('core::message.update_failed')
            ], 400);
        }

        return (new ConstructionResource($construction))
            ->additional(['message' => trans('core::message.updated')]);
    }

    public function destroy(Request $request, Construction $construction)
    {
        if (!$this->service->destroy($construction->id, $this->companyId)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    public function forceDestroy(Request $request, Construction $construction)
    {
        if (!$this->service->forceDestroy($construction->id, $this->companyId)) {
            return response()->json([
                'message' => trans('core::message.delete_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.deleted')
        ]);
    }

    public function restore(Request $request, Construction $construction)
    {
        if (!$this->service->restore($construction->id, $this->companyId)) {
            return response()->json([
                'message' => trans('core::message.restore_failed')
            ], 400);
        }

        return response()->json([
            'message' => trans('core::message.restored')
        ]);
    }

    /**
     * Update the construction status to paused.
     *
     * @param Construction $construction
     * @return JsonResponse|ConstructionResource
     */
    public function pause(Construction $construction)
    {
        if ($construction->company_id != $this->companyId) {
            throw (new ModelNotFoundException())->setModel(Construction::Class);
        }

        if ($construction->status != ConstructionStatus::STARTED) {
            return response()->json([
                'message' => trans('construction.pause.message'),
                'error' => trans('construction.pause.status.error')
            ], 400);
        }

        $construction = $this->service
            ->pause($construction);

        if (!$construction) {
            return response()->json([
                'message' => trans('construction.pause_failed')
            ], 400);
        }

        return (new ConstructionResource($construction))
            ->additional(['message' => trans('construction.paused')]);
    }

    /**
     * Update the construction status to started.
     *
     * @param Construction $construction
     * @return JsonResponse|ConstructionResource
     */
    public function start(Construction $construction)
    {
        if ($construction->company_id != $this->companyId) {
            throw (new ModelNotFoundException())->setModel(Construction::Class);
        }

        if ($construction->status != ConstructionStatus::PENDENT && $construction->status != ConstructionStatus::PAUSED) {
            return response()->json([
                'message' => trans('construction.start.message'),
                'error' => trans('construction.start.status.error')
            ], 400);
        }

        $construction = $this->service
            ->start($construction);

        if (!$construction) {
            return response()->json([
                'message' => trans('construction.start_failed')
            ], 400);
        }

        return (new ConstructionResource($construction))
            ->additional(['message' => trans('construction.started')]);
    }

    /**
     * Update the construction status to finalized.
     *
     * @param Construction $construction
     * @return JsonResponse|ConstructionResource
     */
    public function finalize(Construction $construction)
    {
        if ($construction->company_id != $this->companyId) {
            throw (new ModelNotFoundException())->setModel(Construction::Class);
        }

        if ($construction->status != ConstructionStatus::STARTED) {
            return response()->json([
                'message' => trans('construction.finalize.message'),
                'error' => trans('construction.finalize.status.error')
            ], 400);
        }

        $construction = $this->service
            ->finalize($construction);

        if (!$construction) {
            return response()->json([
                'message' => trans('construction.finalize_failed')
            ], 400);
        }

        return (new ConstructionResource($construction))
            ->additional(['message' => trans('construction.finalized')]);
    }

    /**
     * Update the construction status to abandoned.
     *
     * @param Construction $construction
     * @return JsonResponse|ConstructionResource
     */
    public function abandon(Construction $construction)
    {
        if ($construction->company_id != $this->companyId) {
            throw (new ModelNotFoundException())->setModel(Construction::Class);
        }

        if ($construction->status != ConstructionStatus::STARTED && $construction->status != ConstructionStatus::PAUSED) {
            return response()->json([
                'message' => trans('construction.abandon.message'),
                'error' => trans('construction.abandon.status.error')
            ], 400);
        }

        $construction = $this->service
            ->abandon($construction);

        if (!$construction) {
            return response()->json([
                'message' => trans('construction.abandon_failed')
            ], 400);
        }

        return (new ConstructionResource($construction))
            ->additional(['message' => trans('construction.abandoned')]);
    }

    /**
     * Update the construction status to canceled.
     *
     * @param Construction $construction
     * @return JsonResponse|ConstructionResource
     */
    public function cancel(Construction $construction)
    {
        if ($construction->company_id != $this->companyId) {
            throw (new ModelNotFoundException())->setModel(Construction::Class);
        }

        if ($construction->status != ConstructionStatus::PENDENT) {
            return response()->json([
                'message' => trans('construction.cancel.message'),
                'error' => trans('construction.cancel.status.error')
            ], 400);
        }

        $construction = $this->service
            ->cancel($construction);

        if (!$construction) {
            return response()->json([
                'message' => trans('construction.cancel_failed')
            ], 400);
        }

        return (new ConstructionResource($construction))
            ->additional(['message' => trans('construction.canceled')]);
    }
}
