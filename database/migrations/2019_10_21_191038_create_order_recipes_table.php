<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OrderRecipe', function (Blueprint $table) {
            $table->primary(['orderId','recipeId']);
            $table->integer('orderId')->unsigned();
            $table->integer('recipeId')->unsigned();
            $table->foreign('orderId')->references('id')->on('Order');
            $table->foreign('recipeId')->references('id')->on('Recipe');
            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('edited_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('OrderRecipe');
    }
}
