<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGCashInfosTable extends Migration
{
    public function up()
    {
        Schema::create('g_cash_infos', function (Blueprint $table) {
            $table->id();
            $table->string('gcash_name');
            $table->string('gcash_number');
            $table->string('gcash_limit');
            $table->unsignedBigInteger('shop_id'); // Add shop_id column
            $table->unsignedBigInteger('user_id'); // Add user_id column

            $table->timestamps();

            // Add foreign key constraint for shop_id
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            
            // Add foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('g_cash_infos');
    }
}
