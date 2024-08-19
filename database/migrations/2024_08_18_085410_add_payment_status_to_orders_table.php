<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Chứa logic áp dụng thay đổi CSDL
     * Thêm thuộc tính mới sau cột user id
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->after('user_id')->default('cash on delivery');
        });
    }

    /**
     * Reverse the migrations.
     * Chứa logic hoàn tác các áp dụng thay đổi của up -> rollback
     * Xoá cột payment_status
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });
    }
};
