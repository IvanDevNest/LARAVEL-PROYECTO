<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_place');
            $table->foreign('id_place')->references('id')->on('places')
                  ->onUpdate('cascade')->onDelete('cascade');
            // Eloquent does not support composite PK 😦
            // $table->primary(['column1', 'column2']);
        });
        // Eloquent compatibility workaround 🙂
        Schema::table('favorites', function (Blueprint $table) {
            $table->id()->first();
            $table->unique(['id_user', 'id_place']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};