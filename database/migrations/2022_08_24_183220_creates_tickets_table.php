<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('num_ticket')->unique()->unsigned();
            $table->date('date_register')->default(now());
            $table->integer('price')->default(35000);
            $table->bigInteger('id_seller')->nullable();
            $table->foreign('id_seller')->references('id')->on('sellers');
            $table->bigInteger('id_client')->nullable();
            $table->foreign('id_client')->references('id')->on('clients');
            $table->softDeletes();
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
        Schema::dropIfExists('tickets');
    }
};
