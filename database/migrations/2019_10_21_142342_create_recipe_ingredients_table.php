<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RecipeIngredient', function (Blueprint $table) {
            $table->integer('recipeId')->unsigned();

            $table->boolean('isOptional');
            $table->foreign('recipeId')->references('id')->on('Recipe');
            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('edited_at')->useCurrent();
            $table->uuid('created_by');
            $table->foreign('created_by')->references('id')->on('User');
            $table->uuid('edited_by');
            $table->foreign('edited_by')->references('id')->on('User');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RecipeIngredient');
    }
}
