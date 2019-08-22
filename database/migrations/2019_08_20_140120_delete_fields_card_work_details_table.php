<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteFieldsCardWorkDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_work_details', function (Blueprint $table) {
            $table->dropColumn(['material_id', 'dimension', 'weight']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_work_details', function (Blueprint $table) {
            $table->integer('material_id');
            $table->string('dimension');
            $table->decimal('weight', 2);
        });
    }
}
