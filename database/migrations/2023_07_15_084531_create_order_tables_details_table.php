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
        Schema::create('order_tables_details', function (Blueprint $table) {
            $table->comment('Danh sách các bàn trong hóa đơn (khách ngồi nhiều bàn)');
            $table->integer('id', true);
            $table->string('order_id', 11)->nullable()->index('order_tables_details_order_id_fk')->comment('Khoá ngoài bảng order');
            $table->string('table_id', 10)->index('order_tables_details_table_id_fk')->comment('Khoá ngoài bảng table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_tables_details');
    }
};
