<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
         
            $table->string('total_aff_sales_cash')->default("0.00");
            $table->string('total_aff_sales')->default("0.00");
            $table->string('total_vendor_sales_cash')->default("0.00");
            $table->string('total_vendor_sales')->default("0.00");
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
        });
    }
}
