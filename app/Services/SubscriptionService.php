<?php

namespace App\Services;

use App\Http\Requests\SubscriptionStoreRequest;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Txsoura\Core\Services\CoreService;
use Txsoura\Core\Services\Traits\CRUDMethodsService;
use Txsoura\Core\Services\Traits\SoftDeleteMethodsService;

class SubscriptionService extends CoreService
{
    use CRUDMethodsService, SoftDeleteMethodsService;

    protected $storeRequest = SubscriptionStoreRequest::class;

    /**
     * @var SubscriptionRepository
     */
    protected $repository;

    /**
     * SubscriptionService constructor.
     * @param SubscriptionRepository $repository
     */
    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Subscription $subscription
     * @return Subscription|false
     */
    public function activate(Subscription $subscription)
    {
        try {
            return $this->repository->activate($subscription);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * @param Subscription $subscription
     * @return Subscription|false
     */
    public function deactivate(Subscription $subscription)
    {
        try {
            return $this->repository->deactivate($subscription);
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
        return Subscription::class;
    }
}
