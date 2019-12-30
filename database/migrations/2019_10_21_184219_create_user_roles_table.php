<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('UserRole', function (Blueprint $table) {
            $table->uuid('userId');
            $table->integer('roleId')->unsigned();
            $table->primary(['userId','roleId']);
            $table->foreign('userId')->references('id')->on('User');
            $table->foreign('roleId')->references('id')->on('Role');
            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('edited_at')->useCurrent();
            $table->uuid('created_by');
            $table->foreign('created_by')->on('User')->references('id');
            $table->foreign('edited_by')->on('User')->references('id');
            $table->uuid('edited_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('UserRole');
    }
}
