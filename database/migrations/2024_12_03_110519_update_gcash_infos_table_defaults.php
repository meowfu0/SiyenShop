<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGcashInfosTableDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gcash_infos', function (Blueprint $table) {
            $table->string('gcash_name')->nullable()->default(null)->change();
            $table->string('gcash_number')->nullable()->default(null)->change();
            $table->decimal('gcash_limit', 10, 2)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gcash_infos', function (Blueprint $table) {
            // Revert changes if needed
            $table->string('gcash_name')->nullable(false)->change();
            $table->string('gcash_number')->nullable(false)->change();
            $table->decimal('gcash_limit', 10, 2)->nullable(false)->change();
        });
    }
}
