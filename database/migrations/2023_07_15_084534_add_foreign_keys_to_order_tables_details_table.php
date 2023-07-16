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
        Schema::table('order_tables_details', function (Blueprint $table) {
            $table->foreign(['order_id'], 'order_tables_details_order_id_fk')->references(['id'])->on('orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['table_id'], 'order_tables_details_table_id_fk')->references(['id'])->on('tables')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_tables_details', function (Blueprint $table) {
            $table->dropForeign('order_tables_details_order_id_fk');
            $table->dropForeign('order_tables_details_table_id_fk');
        });
    }
};
