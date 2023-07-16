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
        Schema::create('order_extra_items_details', function (Blueprint $table) {
            $table->comment('Thông tin chi tiết hàng thành phẩm trong hóa đơn');
            $table->string('order_id', 10)->index('order_extra_items_details_order_id_fk')->comment('Khóa ngoài của bảng order');
            $table->integer('extra_item_id')->index('order_extra_items_details_item_id_fk')->comment('Khóa ngoài của bảng extra_item');
            $table->integer('quantity_start')->comment('Số lượng phục vụ');
            $table->integer('quantity_not_use')->comment('Số lượng thu về');
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
        Schema::dropIfExists('order_extra_items_details');
    }
};
