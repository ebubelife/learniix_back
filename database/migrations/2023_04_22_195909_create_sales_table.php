<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("sales", function (Blueprint $table) {
            $table->id();
            $table->string('vendor_id')->nullable();
            $table->string('affiliate_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_price')->nullable();
            $table->string('commission')->nullable();
            $table->string('tx_id')->nullable();
           
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
        Schema::dropIfExists('sales');
    }
}
