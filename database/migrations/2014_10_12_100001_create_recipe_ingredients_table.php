<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

            $table->primary(['recipeId','ingredientId']);
            $table->integer('recipeId')->unsigned();
            $table->integer('ingredientId');
            $table->boolean('isOptional');
            $table->foreign('recipeId')->references('id')->on('Recipe');
            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('edited_at')->useCurrent();
            $table->uuid('created_by')->nullable();
            $table->foreign('ingredientId')->references('id')->on('Ingredient');
            $table->foreign('created_by')->references('id')->on('User');
            $table->uuid('edited_by')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('RecipeIngredient');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
