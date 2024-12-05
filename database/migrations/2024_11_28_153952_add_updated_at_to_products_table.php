<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdatedAtToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->timestamp('updated_at')->nullable(); // Add this line
    });
}

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('updated_at'); // Add this line
        });
    }
}
