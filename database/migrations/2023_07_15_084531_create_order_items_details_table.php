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
        Schema::create('order_items_details', function (Blueprint $table) {
            $table->comment('Thông tin chi tiết các món trong hóa đơn');
            $table->string('order_id', 11)->index('order_items_details_order_id_fk')->comment('Khóa ngoài của bảng order');
            $table->integer('item_id')->index('order_items_details_item_id_fk')->comment('Khóa ngoài của bảng item');
            $table->integer('quantity')->comment('Số lượng mỗi món');
            $table->integer('id', true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items_details');
    }
};
