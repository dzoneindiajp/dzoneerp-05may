<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string("country")->nullable();
            $table->string("phone")->nullable();
            $table->string("profile_image")->nullable();
            $table->string("company_name")->nullable();
            $table->string("destignation")->nullable();
            $table->longText("address")->nullable();
            $table->boolean("status")->comment('0 - In-active , 1 - Active')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
