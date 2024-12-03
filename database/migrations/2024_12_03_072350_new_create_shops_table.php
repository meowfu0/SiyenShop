<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewCreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
    Schema::create('new_shops', function (Blueprint $table) {
        $table->id(); // Primary key
        $table->string('shop_name', 255);
        $table->string('shop_description', 255)->nullable();
        $table->string('shop_logo', 255)->nullable();
        $table->unsignedBigInteger('user_id'); // Foreign key
        $table->unsignedBigInteger('status_id'); // Foreign key
        $table->unsignedBigInteger('course_id'); // Foreign key


        $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate(); 
            $table->timestamp('deleted_at')->nullable();

        // Foreign key constraints
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
    });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::dropIfExists('new_shops');
}

    
}
