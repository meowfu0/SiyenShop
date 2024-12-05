<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id'); 
            $table->string('last_name')->after('first_name'); 
            $table->string('phone_number')->after('email'); 
            $table->string('course_bloc')->after('phone_number'); 
            $table->string('year')->after('course_bloc'); 
            $table->unsignedBigInteger('course_id')->after('year');
            $table->string('profile_picture', 255); 
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['course_id']); // Drop foreign key
            $table->dropColumn(['first_name', 'last_name', 'phone_number', 'course_bloc', 'year', 'course_id']); // Drop the columns
            //$table->timestamp('updated_at')->nullable(false)->change(); // Revert updated_at to NOT NULL if necessary
        });
    }
}