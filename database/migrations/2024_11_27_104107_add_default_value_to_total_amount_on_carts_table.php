<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToTotalAmountOnCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->default(0.00)->change();
        });
    }
    
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->decimal('total_amount', 10, 2)->nullable(false)->change();
        });
    }
    
}
