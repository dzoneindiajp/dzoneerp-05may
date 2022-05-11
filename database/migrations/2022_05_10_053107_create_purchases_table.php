<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_code')->unique();
            $table->date('purchase_date')->nullable();
            $table->tinyInteger('user_type')->comment('0 - supplier , 1 - vendor')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->string('product_id')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('unit_price')->nullable();
            $table->string('discount')->nullable();
            $table->double('subtotal')->nullable();
            $table->double('total_discount')->default(00.0);
            $table->double('transport_cost')->default(00.0);
            $table->double('grand_total')->default(00.0);
            $table->double('total_paid')->default(00.0);
            $table->boolean('payment_type')->comment('0 - cash , 1 - card')->default(0);
            $table->longText('purchase_note')->nullable();
            $table->string('purchase_image')->nullable();
            $table->boolean('status')->comment('0 - InActive, 1 - Active')->default(1);
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
        Schema::dropIfExists('purchases');
    }
}
