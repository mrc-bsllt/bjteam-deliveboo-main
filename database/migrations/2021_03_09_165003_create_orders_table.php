<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('guest_name')->required();
            $table->string('guest_address')->required();
            $table->char('order_number',6)->required(); // #00000
            $table->float('total_price',5,2)->required();
            $table->string('counter')->nullable();
            $table->string('email_customer')->required();
            $table->string('status', 10)->default('Pagato'); // pagato, consegnato, in attesa
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
    }
}
