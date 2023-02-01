<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->unsignedBigInteger('restrant_id')->nullable(false);
            $table->date('reserve_date')->nullable(false);
            $table->time('reserve_time')->nullable(false);
            $table->unsignedInteger('people_num')->nullable(false);
            $table->timestamp('visit_at')->nullable();
            $table->unsignedBigInteger('liquid_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('restrant_id')->references('id')->on('restrants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserves');
    }
}