<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsBetweenProjectDetailsAndProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_details', function (Blueprint $table) {
            $table->integer('project_id')->unsigned()->change();
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->integer('material_id')->unsigned()->change();
            $table->foreign('material_id')->references('id')->on('materials')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->integer('component_id')->unsigned()->change();
            $table->foreign('component_id')->references('id')->on('components')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_details', function (Blueprint $table) {
            $table->dropForeign('project_details_project_id_foreign');
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->dropIndex('project_details_project_id_foreign');
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->dropForeign('project_details_material_id_foreign');
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->dropIndex('project_details_material_id_foreign');
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->integer('material_id')->change();
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->dropForeign('project_details_component_id_foreign');
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->dropIndex('project_details_component_id_foreign');
        });

        Schema::table('project_details', function (Blueprint $table) {
            $table->integer('component_id')->change();
        });
    }
}
