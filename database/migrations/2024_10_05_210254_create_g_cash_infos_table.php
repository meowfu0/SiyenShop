<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGCashInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('g_cash_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shop_id');
            
            $table->string('gcash_name', 255);
            $table->string('gcash_number', 255);
            $table->float('gcash_limit');
            
            // Standard Laravel timestamps
            $table->timestamps(); // This includes `created_at` and `updated_at`
            $table->softDeletes(); // Optional: Adds `deleted_at` for soft deletes
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('g_cash_infos');
    }
}
