<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phonenumber')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('edited_at')->useCurrent();
            $table->uuid('created_by')->nullable();
            $table->uuid('edited_by')->nullable();
            $table->foreign('created_by')->on('User')->references('id');
            $table->foreign('edited_by')->on('User')->references('id');
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
        Schema::dropIfExists('User');
    }
}
