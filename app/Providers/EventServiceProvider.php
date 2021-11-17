<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Construction;
use App\Models\ConstructionUser;
use App\Models\Inspection;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Stage;
use App\Models\Stock;
use App\Models\Subscription;
use App\Models\User;
use App\Observers\CompanyObserver;
use App\Observers\CompanyUserObserver;
use App\Observers\ConstructionObserver;
use App\Observers\ConstructionUserObserver;
use App\Observers\InspectionObserver;
use App\Observers\ProductObserver;
use App\Observers\ProviderObserver;
use App\Observers\StageObserver;
use App\Observers\StockObserver;
use App\Observers\SubscriptionObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Company::observe(CompanyObserver::class);
        CompanyUser::observe(CompanyUserObserver::class);
        Subscription::observe(SubscriptionObserver::class);
        Construction::observe(ConstructionObserver::class);
        ConstructionUser::observe(ConstructionUserObserver::class);
        Inspection::observe(InspectionObserver::class);
        Product::observe(ProductObserver::class);
        Provider::observe(ProviderObserver::class);
        Stage::observe(StageObserver::class);
        Stock::observe(StockObserver::class);
        User::observe(UserObserver::class);
    }
}
