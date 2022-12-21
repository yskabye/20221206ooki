<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restrants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 191)->nullable(false);
            $table->unsignedBigInteger('area_id')->nullable(false);
            $table->unsignedBigInteger('genre_id')->nullable(false);
            $table->text('overview')->nullable(false);
            $table->string('image')->nullable(false);
            $table->smallInteger('period')->nullable(false);
            $table->smallInteger('limit')->nullable(false);
            $table->smallInteger('holiday')->nullable(false);
            $table->time('rsv_start')->nullable(false);
            $table->time('rsv_end')->nullable(false);
            $table->smallInteger('timespan')->nullable(false);
            $table->integer('rsv_min')->nullable(false);
            $table->integer('rsv_max')->nullable(false);
            $table->timestamps();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restrants');
    }
}