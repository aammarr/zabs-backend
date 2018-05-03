<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_description')->nullable();
            $table->integer('product_price')->nullable();
            $table->string('product_pic_1')->nullable();
            $table->string('product_pic_2')->nullable();
            $table->string('product_pic_3')->nullable();
            $table->string('product_pic_4')->nullable();
            $table->string('product_pic_5')->nullable();
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
        Schema::dropIfExists('products');
    }
}
