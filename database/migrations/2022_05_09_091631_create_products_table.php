<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('catid')->unsigned();
            $table->bigInteger('subcatid')->unsigned();
            $table->string('product_name');
            $table->bigInteger('unitid')->unsigned();
            $table->string('productimage')->nullable();
            $table->boolean('isfinishedproduct')->default(0)->comment('0 - No , 1 - Yes');
            $table->timestamps();


            // $table->foreign('unitid')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('catid')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcatid')->references('id')->on('categories')->onDelete('cascade');
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
