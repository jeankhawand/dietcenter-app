<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserOrder', function (Blueprint $table) {
            $table->uuid('userId');
            $table->integer('orderId')->unsigned();
            $table->boolean('isDone');
            $table->foreign('userId')->references('id')->on('User')->onDelete('cascade');
            $table->foreign('orderId')->references('id')->on('Order')->onDelete('cascade');
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
        Schema::dropIfExists('UserOrder');
    }
}
