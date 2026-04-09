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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            // foreign key constraint
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('action');
            $table->string('table_name');
            $table->string('old_value');
            $table->string('new_value');
            $table->string('io_addrress');
            $table->integer('record_id');
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
        Schema::dropIfExists('audit_logs');
    }
};
