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
        Schema::create('extra_items', function (Blueprint $table) {
            $table->comment('Các món trong hàng thành phẩm');
            $table->integer('id', true);
            $table->string('name')->comment('Tên món ăn');
            $table->integer('price')->comment('Đơn giá');
            $table->string('unit', 25)->comment('Đơn vị');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_items');
    }
};
