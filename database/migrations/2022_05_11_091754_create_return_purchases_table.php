<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('return_code')->unique();
            $table->string('return_reason')->nullable();
            $table->bigInteger('purchase_id')->unsigned();
            $table->date('return_date');
            $table->string('returnqty')->nullable();
            $table->double('return_amount')->default(00);
            $table->longText('return_note')->nullable();
            $table->string('return_image')->nullable();
            $table->boolean('status')->comment('0 - InActive, 1 - Active')->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('return_purchases');
    }
}
