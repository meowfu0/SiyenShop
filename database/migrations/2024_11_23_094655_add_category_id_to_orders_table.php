<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();  // Add the category_id column
            $table->foreign('category_id')->references('id')->on('categories');  // Define the foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['category_id']);  // Drop the foreign key
            $table->dropColumn('category_id');  // Drop the category_id column
        });
    }
    
}
