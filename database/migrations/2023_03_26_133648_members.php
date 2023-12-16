<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Members extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('members', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('email_code');
            $table->boolean('email_verified')->default(false);
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('phone_code')->nullable();
            $table->boolean('phone_verified')->default(false);
            $table->boolean('is_vendor')->default(false);
            $table->string('affiliate_id');
            $table->string('bank_account_name')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('is_payed')->nullable();

            $table->string('total_aff_sales_cash')->default("0.00");
            $table->string('total_aff_sales')->default("0.00");
            $table->string('total_vendor_sales_cash')->default("0.00");
            $table->string('total_vendor_sales')->default("0.00");
            $table->string('unpaid_balance')->default("0.00");
            $table->string('unpaid_balance_vendor')->default("0.00");
            $table->string('currency')->nullabele();

            $table->string('payment_reference_paystack')->nullable();
            $table->string('payment_reference_flutterwave')->nullable();
            $table->boolean('weekly_withdrawal')->default(true);

            $table->string('last_sale_amount')->nullable();
            $table->timestamp('last_sale_time')->nullable();
            $table->string('last_sale_product')->nullable();

            
            
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
