<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('holder');
            $table->bigInteger('product_id');
            $table->string('name');
            $table->integer('qty');
            $table->float('price');
            $table->bigInteger('weight')->nullable();
            $table->float('discount');
            $table->float('tax');
            $table->float('subtotal');
            $table->float('profit');
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
        Schema::dropIfExists('sale_products');
    }
}
