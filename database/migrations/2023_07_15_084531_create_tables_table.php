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
        Schema::create('tables', function (Blueprint $table) {
            $table->comment('Danh sách các bàn trong nhà hàng');
            $table->string('id', 10)->primary()->comment('Mã bàn');
            $table->integer('quantity')->comment('Số lượng người của mỗi bàn');
            $table->string('state', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
