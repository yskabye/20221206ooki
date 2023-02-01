<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restrant_id')->nullable(false);
            $table->string('subject', 191)->nullable(false);
            $table->text('message')->nullable(false);
            $table->timestamp('send_at')->nullable();
            $table->timestamps();
            $table->foreign('restrant_id')->references('id')->on('restrants');
            $table->unique('restrant_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotes');
    }
}
