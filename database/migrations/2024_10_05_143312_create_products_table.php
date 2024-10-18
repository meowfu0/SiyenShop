<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('shop_id'); 
            $table->unsignedBigInteger('status_id');
            
            $table->string('product_name', 255); 
            $table->text('product_decription'); 
            $table->string('product_image', 255)->nullable();
            $table->float('supplier_price'); 
            $table->float('retail_price'); 
            $table->float('sales_count'); 
            $table->integer('stocks'); 
            
            // Timestamps (Not Null)
            $table->timestamp('created_at')->useCurrent(); 
            $table->timestamp('modified_at')->nullable()->useCurrentOnUpdate(); 
            $table->timestamp('deleted_at')->nullable(); 
            
            // Foreign Key Constraints (Cascade on Delete)
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
