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
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->comment('Hóa đơn');
            $table->string('id', 11)->primary()->comment('Mã đơn hàng gồm 10 ký tự (21HJ4PR59E)');
            $table->integer('state_id')->index('order_order_state_id_fk')->comment('Trạng thái đơn hàng');
            $table->dateTime('created_at')->useCurrent()->comment('Thời gian tạo đơn');
            $table->dateTime('modified_at')->useCurrent()->comment('Thời gian chỉnh sửa đơn');
            $table->integer('total_bill')->nullable()->comment('Tổng giá tiền của đơn');
            $table->integer('customer_id')->nullable()->index('order_customer_id_fk')->comment('Khóa ngoài của bảng customer');
            $table->string('payment', 256)->nullable()->comment('Hình thức thanh toán');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
