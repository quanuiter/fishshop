<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // Bảng lưu bài đăng
    Schema::create('catch_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ai đăng?
        $table->string('image'); // Ảnh chiến lợi phẩm
        $table->text('caption')->nullable(); // Caption: "Hôm nay trúng lớn..."
        $table->timestamps();
    });

    // Bảng trung gian để Tag sản phẩm (Many-to-Many)
    Schema::create('catch_log_product', function (Blueprint $table) {
        $table->id();
        $table->foreignId('catch_log_id')->constrained()->onDelete('cascade');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('catch_log_product');
    Schema::dropIfExists('catch_logs');
}
};
