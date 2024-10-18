<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id(); 
            $table->text('questions');
            $table->text('answers'); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('modified_at')->nullable()->useCurrentOnUpdate(); 
            $table->timestamp('deleted_at')->nullable(); 

            $table->unsignedBigInteger('status_id'); 
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
