<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->longText('image')->nullable();
            $table->text('vendor_id');
            $table->longText('productName');
            $table->longText('productDescription');
            $table->string('productPrice');
            $table->string('productCategory');
            $table->string('productCommission');
            $table->longText('productSalesPageLink');
            $table->string('ProductTYLink');
            $table->string('productJVLink');
            $table->boolean('approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
