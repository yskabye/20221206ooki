<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('users', function (Blueprint $table) {
        //$table->foreignId('type_id')->constrainted();
        $table->foreign('type_id')->references('id')->on('types');
        });
        Schema::table('restrants', function (Blueprint $table) {
        //$table->foreignId('area_id')->constrainted();
        $table->foreign('area_id')->references('id')->on('areas');
        });
        Schema::table('restrants', function (Blueprint $table) {
        //$table->foreignId('genre_id')->constrainted();
        $table->foreign('genre_id')->references('id')->on('genres');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('users', function (Blueprint $table) {
        $table->dropForeign('users_type_id_foreign');
        });*/

        /*Schema::table('restrants', function (Blueprint $table) {
        $table->dropForeign('restrants_area_id_foreign');
        });
        Schema::table('restrants', function (Blueprint $table) {
        $table->dropForeign('restrants_genre_id_foreign');
        });*/
    }
}