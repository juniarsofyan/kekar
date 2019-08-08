<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardWorkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_work_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('card_work_id');
            $table->integer('component_id');
            $table->integer('material_id');
            $table->string('dimension');
            $table->text('problem');
            $table->text('solution');
            $table->integer('total_hours');
            $table->integer('qty');
            $table->decimal('weight', 2);
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
        Schema::dropIfExists('card_work_details');
    }
}
