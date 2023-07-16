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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->comment('Thông tin nhà hàng');
            $table->integer('id', true);
            $table->string('name', 256)->comment('Tên nhà hàng');
            $table->string('tax_code', 11)->comment('Mã số thuế');
            $table->string('name_leader', 256)->comment('Thông tin chủ cửa hàng');
            $table->string('address', 256)->comment('Địa chỉ nhà hàng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
};
