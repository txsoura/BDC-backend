<?php

use App\Enums\StockFlow;
use App\Enums\StockStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->decimal('quantity', 10)->default(0.00);
            $table->decimal('price', 10)->default(0.00);
            $table->foreignId('construction_id')->references('id')->on('constructions');
            $table->foreignId('provider_id')->references('id')->on('providers');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->enum('flow', StockFlow::toArray());
            $table->enum('status', StockStatus::toArray())->default(StockStatus::PENDENT);
            $table->string('outgoing_receiver')->nullable();
            $table->string('receipt')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('received_at')->nullable();
            $table->timestamp('withdrawn_at')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
