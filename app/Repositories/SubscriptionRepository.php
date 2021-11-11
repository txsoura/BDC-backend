<?php

namespace App\Repositories;

use App\Enums\SubscriptionStatus;
use App\Models\Subscription;
use Txsoura\Core\Repositories\CoreRepository;
use Txsoura\Core\Repositories\Traits\SoftDeleteMethodsRepository;

class SubscriptionRepository extends CoreRepository
{
    use SoftDeleteMethodsRepository;

    /**
     * Allow model relations to use in include
     * @var array
     */
    protected $possibleRelationships = ['company'];

    /**
     * Allowed model columns to use in conditional query
     * @var array
     */
    protected $allow_where = array('status', 'billing_method', 'valid_until', 'amount', 'company_id', 'currency');

    /**
     * Allowed model columns to use in sort
     * @var array
     */
    protected $allow_order = array('status', 'billing_method', 'valid_until', 'amount', 'company_id', 'currency', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in query search
     * @var array
     */
    protected $allow_like = array('title');

    /**
     * Allowed model columns to use in filter by date
     * @var array
     */
    protected $allow_between_dates = array('valid_until', 'created_at', 'updated_at');

    /**
     * Allowed model columns to use in filter by value
     * @var array
     */
    protected $allow_between_values = array('amount');


    /**
     * @param Subscription $subscription
     * @return Subscription|null
     */
    public function activate(Subscription $subscription): ?Subscription
    {
        $subscription->status = SubscriptionStatus::ACTIVE;
        $subscription->update();

        return $subscription;
    }

    /**
     * @param Subscription $subscription
     * @return Subscription|null
     */
    public function deactivate(Subscription $subscription): ?Subscription
    {
        $subscription->status = SubscriptionStatus::DEACTIVATED;
        $subscription->update();

        return $subscription;
    }

    protected function model(): string
    {
        return Subscription::class;
    }
}
