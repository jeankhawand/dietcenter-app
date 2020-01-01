<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Recipe', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->longText('image');
            $table->double('price');
            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('edited_at')->useCurrent();
            $table->uuid('created_by')->nullable();
            $table->uuid('edited_by')->nullable();
            $table->uuid('organizationId')->nullable();
            $table->foreign('organizationId')->on('Organization')->references('id');
            $table->foreign('created_by')->on('User')->references('id');
            $table->foreign('edited_by')->on('User')->references('id');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('Recipe');
//        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
