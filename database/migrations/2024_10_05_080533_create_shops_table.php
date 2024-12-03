<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id(); // Primary key
            
            // Timestamps
            $table->timestamp('created_at')->useCurrent(); // Auto-filled with current timestamp
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate(); // Updated timestamp auto-handled
            $table->timestamp('deleted_at')->nullable(); // Nullable for soft deletes
            
            // Other fields
            $table->string('shop_name', 255);
            $table->text('shop_description')->nullable(); // Nullable description
            $table->string('shop_logo', 255)->nullable(); // Nullable logo
            
            // Foreign keys
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('status_id'); 
            $table->unsignedBigInteger('course_id');
            
            // Foreign key constraints with cascading on delete
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
        Schema::dropIfExists('shops');
    }
}
