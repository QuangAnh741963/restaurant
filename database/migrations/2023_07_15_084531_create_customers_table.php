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
        Schema::create('customers', function (Blueprint $table) {
            $table->comment('Thông tin khách hàng');
            $table->integer('id', true);
            $table->string('name', 256)->nullable()->comment('Họ tên khách hàng');
            $table->string('phone', 256)->nullable()->comment('Số điện thoại khách hàng');
            $table->string('email', 256)->comment('Email của khách hàng')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
