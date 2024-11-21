<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGcashNumberToBigintInGCashInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('g_cash_infos', function (Blueprint $table) {
        $table->string('gcash_number')->change();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('g_cash_infos', function (Blueprint $table) {
        $table->integer('gcash_number')->change();
    });
}
}
