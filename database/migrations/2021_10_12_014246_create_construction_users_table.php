<?php

use App\Enums\ConstructionUserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construction_users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ConstructionUserRole::toArray())->default(ConstructionUserRole::OWNER);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('construction_id')->references('id')->on('constructions');
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
        Schema::dropIfExists('construction_users');
    }
}
