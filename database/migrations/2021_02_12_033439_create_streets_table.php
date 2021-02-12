<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('postal_code')->index();
            $table->foreign('postal_code')->references('id')->on('postal_codes')->onDelete('cascade');

            $table->string('route');
            $table->decimal('latitude', 10, 7)->nullable()->default(0);
            $table->decimal('longitude', 10, 7)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streets');
    }
}
