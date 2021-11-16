<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_sales', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('number')->nullable();
            $table->double('price_total');
            $table->float('tax');
            $table->float('discount');
            $table->double('total');
            $table->date('sale_date');
            $table->bigInteger('payment');
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
        Schema::dropIfExists('shop_sales');
    }
}
