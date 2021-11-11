<?php

namespace App\Http\Controllers;

use App\Enums\SubscriptionStatus;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use App\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;
use Txsoura\Core\Http\Controllers\Traits\CRUDMethodsController;
use Txsoura\Core\Http\Controllers\Traits\SoftDeleteMethodsController;

class SubscriptionController extends Controller
{
    use CRUDMethodsController, SoftDeleteMethodsController;

    /**
     * @var SubscriptionRepository
     */
    protected $repository;

    /**
     * @var SubscriptionResource
     */
    protected $resource = SubscriptionResource::class;

    /**
     * @var SubscriptionService
     */
    protected $service;

    /**
     * SubscriptionController constructor.
     */
    public function __construct(SubscriptionService $service, SubscriptionRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Update the subscription status to activate.
     *
     * @param Subscription $subscription
     * @return JsonResponse|SubscriptionResource
     */
    public function activate(Subscription $subscription)
    {
        if ($subscription->valid_until < now()) {
            return response()->json([
                'error' => trans('subscription.activate.error'),
                'message' => trans('subscription.activate.message')
            ], 400);
        }
        $subscription = $this->service
            ->activate($subscription);

        if (!$subscription) {
            return response()->json([
                'message' => trans('subscription.activate_failed')
            ], 400);
        }

        return (new SubscriptionResource($subscription))
            ->additional(['message' => trans('subscription.activated')]);
    }

    /**
     * Update the subscription status to deactivated.
     *
     * @param Subscription $subscription
     * @return JsonResponse|SubscriptionResource
     */
    public function deactivate(Subscription $subscription)
    {
        if ($subscription->status != SubscriptionStatus::PENDENT) {
            return response()->json([
                'error' => trans('subscription.deactivate.error'),
                'message' => trans('subscription.deactivate.message')
            ], 400);
        }

        $subscription = $this->service
            ->deactivate($subscription);

        if (!$subscription) {
            return response()->json([
                'message' => trans('subscription.deactivate_failed')
            ], 400);
        }

        return (new SubscriptionResource($subscription))
            ->additional(['message' => trans('subscription.deactivated')]);
    }
}
