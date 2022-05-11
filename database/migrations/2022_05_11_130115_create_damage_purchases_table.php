<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamagePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damage_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('damage_code')->unique();
            $table->string('damage_reason')->nullable();
            $table->bigInteger('purchase_id')->unsigned();
            $table->date('damage_date');
            $table->string('damageqty')->nullable();
            $table->longText('damage_note')->nullable();
            $table->string('damage_image')->nullable();
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
        Schema::dropIfExists('damage_purchases');
    }
}
