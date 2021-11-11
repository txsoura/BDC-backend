<?php

use App\Enums\Currency;
use App\Enums\SubscriptionBillingMethod;
use App\Enums\SubscriptionStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('status', SubscriptionStatus::toArray())->default(SubscriptionStatus::PENDENT);
            $table->enum('billing_method', SubscriptionBillingMethod::toArray());
            $table->timestamp('valid_until');
            $table->decimal('amount', 10)->default(0.00);
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->enum('currency', Currency::toArray())->default(Currency::BRL);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
