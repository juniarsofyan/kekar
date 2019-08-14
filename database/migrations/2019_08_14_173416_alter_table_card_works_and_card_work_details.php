<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCardWorksAndCardWorkDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_works', function (Blueprint $table) {
            $table->text('po_number')->nullable()->change();
        });

        Schema::table('card_work_details', function (Blueprint $table) {
            $table->text('dimension')->nullable()->change();
            $table->text('weight')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_works', function (Blueprint $table) {
            $table->text('po_number')->change();
        });

        Schema::table('card_work_details', function (Blueprint $table) {
            $table->text('dimension')->change();
            $table->text('weight')->change();
        });
    }
}
