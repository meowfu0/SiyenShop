<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisibilityIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add visibility_id column
            $table->unsignedBigInteger('visibility_id')->after('status_id');

            // Add foreign key constraint
            $table->foreign('visibility_id')->references('id')->on('visibilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key constraint and column
            $table->dropForeign(['visibility_id']);
            $table->dropColumn('visibility_id');
        });
    }
}
