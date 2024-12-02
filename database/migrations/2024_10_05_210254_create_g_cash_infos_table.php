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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('g_cash_infos');
    }
}
