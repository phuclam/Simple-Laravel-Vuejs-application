<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('capacity_id');
            $table->double('price');
            $table->string('day_type', 10);

            $table->unique(['type_id', 'capacity_id', 'day_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
