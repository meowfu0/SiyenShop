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
            $table->id(); 

            // Nullable timestamps
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('modified_at')->nullable()->useCurrentOnUpdate(); 
            $table->timestamp('deleted_at')->nullable();
            
            // Other fields
            $table->string('shop_name', 255); 
            $table->string('shop_description', 255); // Replacing shop_description with shop_email
            $table->string('shop_logo', 255)->nullable(); 

            // Foreign keys with not null and cascade on delete
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
