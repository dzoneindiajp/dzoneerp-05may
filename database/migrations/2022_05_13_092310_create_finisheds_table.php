<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finisheds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('processing_id')->unsigned();
            $table->bigInteger('purchase_id')->unsigned();
            $table->string('finished_code')->unique();
            $table->string('product_name')->nullable();
            $table->string('purchase_qty')->nullable();
            $table->string('available_qty')->nullable();
            $table->string('unit_name')->nullable();
            $table->string('used_qty')->nullable();
            $table->string('finished_note')->nullable();
            $table->date('finished_date')->nullable();
            $table->string('finished_image')->nullable();
            $table->boolean('status')->comment('0 - InActive , 1 - Active')->default(1);
            $table->timestamps();

            $table->foreign('processing_id')->references('id')->on('processings')->onDelete('cascade');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finisheds');
    }
}
