<?php

namespace App\Http\Controllers;

use App\Enums\ConstructionStatus;
use App\Http\Resources\ConstructionResource;
use App\Models\Construction;
use App\Repositories\ConstructionRepository;
use App\Services\ConstructionService;
use Illuminate\Http\JsonResponse;
use Txsoura\Core\Http\Controllers\Traits\CRUDMethodsController;
use Txsoura\Core\Http\Controllers\Traits\SoftDeleteMethodsController;

class ConstructionController extends Controller
{
    use CRUDMethodsController, SoftDeleteMethodsController;

    /**
     * @var ConstructionRepository
     */
    protected $repository;

    /**
     * @var ConstructionResource
     */
    protected $resource = ConstructionResource::class;

    /**
     * @var ConstructionService
     */
    protected $service;

    /**
     * ConstructionController constructor.
     */
    public function __construct(ConstructionService $service, ConstructionRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Update the construction status to paused.
     *
     * @param Construction $construction
     * @return JsonResponse|ConstructionResource
     */
    public function pause(Construction $construction)
    {
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

        return (new $this->resource($construction))
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

        return (new $this->resource($construction))
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

        return (new $this->resource($construction))
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

        return (new $this->resource($construction))
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

        return (new $this->resource($construction))
            ->additional(['message' => trans('construction.canceled')]);
    }
}
