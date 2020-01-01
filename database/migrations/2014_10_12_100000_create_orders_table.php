<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stripeId');
            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('updated_at')->useCurrent();
            $table->uuid('userId')->nullable();
            $table->foreign('userId')->on('User')->references('id');
            $table->uuid('organizationId')->nullable();
            $table->foreign('organizationId')->on('Organization')->references('id');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('Order');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
