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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->longText('recipient_address')->nullable();
            $table->bigInteger('total_price')->default(0);
            $table->bigInteger('discount')->default(0);
            $table->bigInteger('paid_price')->default(0);
            $table->bigInteger('debt')->default(0);
            $table->smallInteger('order_status')->default(0)->comment('0: Lên đơn; 1: Đang vận chuyển; 2: Hoàn thành; 3: Hủy;');
            $table->smallInteger('payment_status')->default(1)->comment('1: Đã thanh toán; 2: Chưa thanh toán; 3: Nợ;');

            $table->timestamps();
        });

        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->bigInteger('product_id');
            $table->integer('quantity')->default(1)->nullable();
            $table->bigInteger('price')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_products');
    }
};
