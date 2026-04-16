<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_name');
            $table->string('email' ,191)->unique();
            $table->string('password');
            $table->boolean('active_flag')->default(true);
            $table->boolean('admin_flag')->default(false);
            $table->boolean('owner_flag')->default(false);
            $table->bigInteger('role_id')->unsigned();
            $table->boolean('email_verified');
            $table->string('password_reset_code');
            $table->timestamp('password_reset_expires');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
