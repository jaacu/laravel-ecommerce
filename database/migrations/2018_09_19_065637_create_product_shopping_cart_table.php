<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductShoppingCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shopping_cart', function (Blueprint $table) {
            $table->integer('product_id'); // The product id
            $table->integer('shopping_cart_id'); // The cart id
            
            $table->timestamps(); 
            $table->integer('amount'); // The amount of units per item in the cart

            $table->primary(['product_id' , 'shopping_cart_id' ]); // Make primay keys the product and cart id's
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_shopping_cart');
    }
}
