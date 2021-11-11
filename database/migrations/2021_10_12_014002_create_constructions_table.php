<?php

use App\Enums\ConstructionStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->enum('status', ConstructionStatus::toArray())->default(ConstructionStatus::PENDENT);
            $table->decimal('budget', 10)->default(0.00);
            $table->string('project')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamp('abandoned_at')->nullable();
            $table->foreignId('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('constructions');
    }
}
