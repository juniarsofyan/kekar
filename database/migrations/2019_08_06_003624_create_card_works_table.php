<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_works', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('category_id');
            $table->string('po_number');
            $table->integer('inventory_id');
            $table->integer('process_id');
            $table->integer('customer_id');
            $table->integer('project_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('card_works');
    }
}
