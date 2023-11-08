<?php

use Illuminate\Http\Request;
use App\Http\Controllers\MembersController;
use App\Models\Members;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorsController;

use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\SalesController;

use App\Models\Vendors;
use App\Models\Products;
use App\Models\Transactions;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Mail\MessageEmail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TransactionsController::class)->group(function(){
    Route::post('transaction/vendor/reg', 'store');
    Route::get('transactions/view/all', 'show');
   
   // Route::get('transactions/view/affiliate_payments', 'store_product');

    //retrieve affiliate payments

    Route::get('transactions/view/affiliate_payments/{id}', function ($id) {
        $affiliate_payments = Transactions::where('tx_type', 'AFFILIATE_PAYMENT')
        ->where('user_id',$id)
        ->orderByDesc('created_at')
       
        ->get();
    
        return response()->json( $affiliate_payments);
    });

    Route::get('transactions/view/affiliate_payments/all', function () {
        $affiliate_payments = Transactions::where('tx_type', 'AFFILIATE_PAYMENT')
       // ->where('user_id',$id)
        ->orderByDesc('created_at')
       
        ->get();
    
        return response()->json( $ffiliate_payments);
    });

    Route::get('transactions/view/vendor_payments/{id}', function ($id) {
        $vendor_payments = Transactions::where('tx_type', 'VENDOR_PAYMENT')
        ->where('user_id',$id)
        ->orderByDesc('created_at')
        ->get();
    
        return response()->json($vendor_payments);
    });


 

    Route::get('pay/affiliates', 'pay_affiliates');

    Route::get('pay/vendors', 'pay_vendors');

    

});





Route::controller(MembersController::class)->group(function(){
    Route::post('signup', 'store');
    Route::post('login', 'login');
    Route::post('verify_email_otp', 'verify_email_otp');
    Route::post('send_email', 'send_email');
    Route::get('test','test');
    Route::post('addVendor','createVendor');
    Route::post('update/isvendor','update');
    Route::get('email/test','test_email');
    Route::post('account/recover','send_mail_code');

    Route::get('/emails/send_aff_emails','send_email_to_all_affiliates');
    //Route::get('view/user/{id}', 'view_user');






       /*code to update members database */


      
       Route::get('update/aff/data/', function () {

        $json_d = '[
            {
                "id": 55,
                "firstName": "Emmanuel",
                "lastName": "Adekunle",
                "email": "emmanueldekunle0@gmail.com",
                "email_code": "2544",
                "email_verified": 1,
                "password": "$2y$10$ULVYIkgfwhNv.uY3COQKsOlr7VMWUeV81pJ3Zkwk0Cveiv5o3diKS",
                "phone": "08064698403",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ClvVya",
                "created_at": "2023-05-28T22:46:41.000000Z",
                "updated_at": "2023-07-16T04:02:38.000000Z",
                "bank_account_name": "Emmanuel Adekunle Alao",
                "bank": "044",
                "bank_account_number": "1547991233",
                "is_payed": "true",
                "total_aff_sales_cash": "15000",
                "total_aff_sales": "3",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_53wwwb4souzoxc7",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 56,
                "firstName": "DAMIAN LOVE",
                "lastName": "IFEANYI",
                "email": "loveebubechukwudamian@gmail.com",
                "email_code": "5951",
                "email_verified": 1,
                "password": "$2y$10$AGPrbue3GTKgPt0syFLSfezac40ljrTj8YuAfpxbs\/vk\/4jB0Se.C",
                "phone": "08062782206",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "mF1Pqi",
                "created_at": "2023-05-28T22:51:30.000000Z",
                "updated_at": "2023-09-02T10:29:11.000000Z",
                "bank_account_name": "DAMIAN LOVE IFEANYI",
                "bank": "033",
                "bank_account_number": "2271490678",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_pwribklqjj5i0o6",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 57,
                "firstName": "Rapuru",
                "lastName": "Prince",
                "email": "rapuruchukwuprince@gmail.com",
                "email_code": "3155",
                "email_verified": 1,
                "password": "$2y$10$HcEtoTG0pDr.tkLY8whMFeFzDJKG2hPaWj7SwaVQ7fCUf1gGagVYO",
                "phone": "07057432016",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "FQmKeb",
                "created_at": "2023-05-28T23:05:05.000000Z",
                "updated_at": "2023-10-15T00:14:59.000000Z",
                "bank_account_name": "Prince Rapuruchukwu Ikechukwu",
                "bank": "057",
                "bank_account_number": "2405927593",
                "is_payed": "true",
                "total_aff_sales_cash": "55000",
                "total_aff_sales": "11",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_oxp9bzcvenop3iy",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-09-24 18:36:33",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 58,
                "firstName": "Chinedu Victor",
                "lastName": "OPARA",
                "email": "chinedujongsu153@gmail.com",
                "email_code": "5412",
                "email_verified": 1,
                "password": "$2y$10$jLCUOILz9O8M9YsC9d42U.MWlBp2.N4MApWni2v8GZoVeSZtX1gKG",
                "phone": "07065316738",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "nVfac5",
                "created_at": "2023-05-28T23:08:52.000000Z",
                "updated_at": "2023-10-28T12:13:26.000000Z",
                "bank_account_name": "OPARA Chinedu Victor",
                "bank": "035",
                "bank_account_number": "8547114132",
                "is_payed": "true",
                "total_aff_sales_cash": "25000",
                "total_aff_sales": "5",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "10000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_5xc90exxqj2r3s5",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-28 12:13:26",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 59,
                "firstName": "OPEMIPOSI",
                "lastName": "Oni",
                "email": "opemiposiolusola43@gmail.com",
                "email_code": "6356",
                "email_verified": 1,
                "password": "$2y$10$QfQOwhDmFo6UAtpr6UmnUeLvxCNL7Llmdx772MC5D\/1wbPpC02uYq",
                "phone": "08164556113",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "xiWUuG",
                "created_at": "2023-05-28T23:14:17.000000Z",
                "updated_at": "2023-11-05T00:41:28.000000Z",
                "bank_account_name": "ONI OLUSOLA OPEMIPOSI",
                "bank": "044",
                "bank_account_number": "0020686811",
                "is_payed": "true",
                "total_aff_sales_cash": "75000",
                "total_aff_sales": "15",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ncapuye18yqhcuo",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-04 17:34:27",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 60,
                "firstName": "Samari",
                "lastName": "Blessing",
                "email": "Blessingsamari255@gmail.com",
                "email_code": "5122",
                "email_verified": 1,
                "password": "$2y$10$X8j5aAmvb1G9y.2E2drZWeUJjZgdTPMLHfYvWVbzhu2hWSdurS4Wa",
                "phone": "09025180980",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "9stvgc",
                "created_at": "2023-05-28T23:16:02.000000Z",
                "updated_at": "2023-07-30T06:08:50.000000Z",
                "bank_account_name": "SAMARI ABUENA BLESSING",
                "bank": "057",
                "bank_account_number": "2150270427",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_1tcljx6l6khsqj1",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-07-28 14:36:58",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 61,
                "firstName": "saheed",
                "lastName": "Olajire",
                "email": "olajiresaheed8@gmail.com",
                "email_code": "2193",
                "email_verified": 1,
                "password": "$2y$10$5fG8E6fOYT3CzDR4Nhlco.hOjqk4zqumFNbSwhfPE19noGaeATJba",
                "phone": "07033605819",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "izyDcx",
                "created_at": "2023-05-28T23:17:18.000000Z",
                "updated_at": "2023-05-28T23:31:26.000000Z",
                "bank_account_name": "Olajire saheed mayowa",
                "bank": "058",
                "bank_account_number": "0670730299",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_fxi9dm4y7qs2asx",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 63,
                "firstName": "Olaitan",
                "lastName": "Musbaudeen",
                "email": "muizmusbaudeen2003@gmail.com",
                "email_code": "4808",
                "email_verified": 1,
                "password": "$2y$10$LqwZWlrA6wWXsLU7996XveMZx3Xk3florV75dNilSuGCkueQJ5dSC",
                "phone": "07069278916",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "qkHGQY",
                "created_at": "2023-05-28T23:31:18.000000Z",
                "updated_at": "2023-05-28T23:40:12.000000Z",
                "bank_account_name": "Muiz Musbaudeen Olaitan",
                "bank": "033",
                "bank_account_number": "2204897042",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ehnfj3c9lg1oxan",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 64,
                "firstName": "Jennifer",
                "lastName": "Iroh",
                "email": "jenniferiroh651@gmail.com",
                "email_code": "1067",
                "email_verified": 1,
                "password": "$2y$10$qPGoPFGVxg8oQT\/I.4kMaeklrpg2A942XZm9bK.Xy3BOXk1n\/Y3tm",
                "phone": "08023985076",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "R6bpdg",
                "created_at": "2023-05-28T23:34:29.000000Z",
                "updated_at": "2023-11-05T07:51:57.000000Z",
                "bank_account_name": "Iroh Jennifer Chidinma",
                "bank": "033",
                "bank_account_number": "2236071645",
                "is_payed": "true",
                "total_aff_sales_cash": "70000",
                "total_aff_sales": "14",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "30000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_opmxmo9hepkd922",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-05 07:51:57",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 65,
                "firstName": "Gbenga",
                "lastName": "Famakinwa",
                "email": "mosesgbenga670@gmail.com",
                "email_code": "4962",
                "email_verified": 1,
                "password": "$2y$10$XLodAWhDMuvHBKvECWj1o.sB73eL.r1Aad0p\/bEnrX2sJxgrSQz6i",
                "phone": "08107722894",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "plDjem",
                "created_at": "2023-05-28T23:38:03.000000Z",
                "updated_at": "2023-09-26T02:36:53.000000Z",
                "bank_account_name": "Famakinwa Gbenga Moses",
                "bank": "050",
                "bank_account_number": "4151135234",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_q54skhtuxm3z9uc",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 66,
                "firstName": "HASSANAT",
                "lastName": "TIJANI",
                "email": "tijanihassanat97@gmail.com",
                "email_code": "3286",
                "email_verified": 1,
                "password": "$2y$10$Prc9yFiILE02HLXd1DQhtewPPqpDNKSQ0aSqvhRimmqH3dTeMY186",
                "phone": "08146434925",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "axSKP2",
                "created_at": "2023-05-28T23:44:39.000000Z",
                "updated_at": "2023-05-29T00:03:45.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 68,
                "firstName": "Kudirat",
                "lastName": "Olayinka",
                "email": "yinkaml@outlook.com",
                "email_code": "2689",
                "email_verified": 1,
                "password": "$2y$10$GOKjxP4j1nh85K3Hf15BUuge6j.JLIMXscY0Akxw7VDXvYdFyU756",
                "phone": "08131389847",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Wj42yA",
                "created_at": "2023-05-29T00:13:48.000000Z",
                "updated_at": "2023-07-22T20:12:15.000000Z",
                "bank_account_name": "Kudirat Olayinka Adelase-Lawal",
                "bank": "058",
                "bank_account_number": "0051768734",
                "is_payed": "true",
                "total_aff_sales_cash": "40000",
                "total_aff_sales": "8",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "5000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_hu5k3e9wpja8oko",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-07-21 16:47:27",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 69,
                "firstName": "Rita",
                "lastName": "Okoekhian",
                "email": "okoekhianrita@gmail.com",
                "email_code": "5215",
                "email_verified": 1,
                "password": "$2y$10$Ib.P.zozxHFGoUgveTRc9eL8x99eg4C3x8MClYEeC6jUA5d94YZMG",
                "phone": "09019397592",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "vmB8Gy",
                "created_at": "2023-05-29T00:18:48.000000Z",
                "updated_at": "2023-07-02T01:56:16.000000Z",
                "bank_account_name": "Okoekhian Rita Oselenjakhian",
                "bank": "058",
                "bank_account_number": "0163350599",
                "is_payed": "true",
                "total_aff_sales_cash": "20000",
                "total_aff_sales": "4",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_mnj5j307c19myge",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 70,
                "firstName": "Faith",
                "lastName": "Joseph",
                "email": "faithdammy205@gmail.com",
                "email_code": "6806",
                "email_verified": 1,
                "password": "$2y$10$jVVjIJIAnY8YL.Ko.JLdBu6hXFvxzhHQrAsiXh4OMXnzM9w5edsne",
                "phone": "08144364932",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "zUyFk2",
                "created_at": "2023-05-29T00:26:53.000000Z",
                "updated_at": "2023-09-27T18:51:06.000000Z",
                "bank_account_name": "Faith Damilola Joseph",
                "bank": "999992",
                "bank_account_number": "8144364932",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_9zz3krlrxcjpp4v",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 71,
                "firstName": "Abayomi",
                "lastName": "Olusegun",
                "email": "legitonlinebusiness21@gmail.com",
                "email_code": "8324",
                "email_verified": 1,
                "password": "$2y$10$ICXzVgJS156q\/QLIroUdxO21CDLLqltNjBWn1X5RbjApldmfSLGaO",
                "phone": "08062205385",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "y0fwGm",
                "created_at": "2023-05-29T00:38:31.000000Z",
                "updated_at": "2023-11-04T20:59:20.000000Z",
                "bank_account_name": "Abayomi Charles Olusegun",
                "bank": "999992",
                "bank_account_number": "8062205385",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_l3c3bii21y7dzql",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 72,
                "firstName": "Oluwafisayomi",
                "lastName": "Ifejube",
                "email": "fizzyp04@gmail.com",
                "email_code": "3777",
                "email_verified": 1,
                "password": "$2y$10$0TLf3K3KeFqfcfCcI1WCO.7Hyo8AvvJs81lIasERbWIvwP0MyWsku",
                "phone": "09045259080",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "pRswZE",
                "created_at": "2023-05-29T00:47:30.000000Z",
                "updated_at": "2023-05-29T01:12:57.000000Z",
                "bank_account_name": "Oluwafisayomi Precious Ifejube",
                "bank": "999992",
                "bank_account_number": "9045259080",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_xvcxo98bz3eoc1r",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 73,
                "firstName": "Omoloye",
                "lastName": "Victoria",
                "email": "omoloyevictoria66@gmail.com",
                "email_code": "4990",
                "email_verified": 1,
                "password": "$2y$10$pQJZqtVOu7r92ijyR8MFqeAaiN9Zu7nvuUtRBISo6\/cXRE2Zu6Bwm",
                "phone": "09022972313",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "7thFqB",
                "created_at": "2023-05-29T00:59:45.000000Z",
                "updated_at": "2023-05-29T03:11:31.000000Z",
                "bank_account_name": "Omoloye omor Victoria",
                "bank": "032",
                "bank_account_number": "0108275648",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_n2fwyqo2gmsi5nn",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 74,
                "firstName": "David",
                "lastName": "Elems",
                "email": "navysseaman@gmail.com",
                "email_code": "7402",
                "email_verified": 1,
                "password": "$2y$10$0RuOxApTv9\/zEHk19.up.uVplprvuSirgdEYWYY1AjjA4\/RpJszx2",
                "phone": "09151957401",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "kYMtqc",
                "created_at": "2023-05-29T01:00:31.000000Z",
                "updated_at": "2023-05-29T09:30:08.000000Z",
                "bank_account_name": "Elems David",
                "bank": "011",
                "bank_account_number": "3196098156",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_kf4pph63dhk4fwo",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 75,
                "firstName": "Amanda",
                "lastName": "Okeke",
                "email": "amandaokeke22@gmail.com",
                "email_code": "8023",
                "email_verified": 1,
                "password": "$2y$10$6GyEzmJcU1XtE1YDS7ngMOkrQgbZ1F463ywAaYp1Qaenk8ub3W8jK",
                "phone": "07018073096",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "VQfAoY",
                "created_at": "2023-05-29T01:06:42.000000Z",
                "updated_at": "2023-07-07T11:35:49.000000Z",
                "bank_account_name": "Onyinyechukwu Amanda Okeke",
                "bank": "214",
                "bank_account_number": "1002029030",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ddshy4nkhljk3k5",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 76,
                "firstName": "Ayodele",
                "lastName": "Onafeso",
                "email": "ayurmuzik@gmail.com",
                "email_code": "7568",
                "email_verified": 1,
                "password": "$2y$10$ElhQxuiLOD67BG8CyPor6eykKIOThrGAjvg0n7aZl90LcV0VnQmES",
                "phone": "08023802948",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "7qGPRY",
                "created_at": "2023-05-29T01:19:51.000000Z",
                "updated_at": "2023-05-29T01:24:46.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 77,
                "firstName": "Paul",
                "lastName": "Onokpa",
                "email": "ponokpa@gmail.com",
                "email_code": "4346",
                "email_verified": 1,
                "password": "$2y$10$3gireVdr7N94SDJ0Xoq03uyd7R8Vgfbn0KTCCilEl8Qsoy4Mt7iIG",
                "phone": "08034392211",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "LhsG0i",
                "created_at": "2023-05-29T01:30:30.000000Z",
                "updated_at": "2023-05-29T05:34:53.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 78,
                "firstName": "Mary",
                "lastName": "Sunday",
                "email": "quinportable@gmail.com",
                "email_code": "2076",
                "email_verified": 1,
                "password": "$2y$10$RzD.BGVfR0dmmYc1v\/8KIuDIIiONaG80LZjOmzE9BKOJXxcwPPdkm",
                "phone": "07063558011",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "k0gdW7",
                "created_at": "2023-05-29T01:47:41.000000Z",
                "updated_at": "2023-05-29T06:38:46.000000Z",
                "bank_account_name": "Mary Abosede Sunday",
                "bank": "999992",
                "bank_account_number": "8102798110",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_u0wnbyr0wi5llil",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 79,
                "firstName": "MIRACLE",
                "lastName": "IDOKO",
                "email": "idokomiracle124@gmail.com",
                "email_code": "3409",
                "email_verified": 1,
                "password": "$2y$10$OY5ECmlIrUhn6I8YaoDl0Om8L2gLqAdySaT2p87PbUelej3dziF..",
                "phone": "09137071898",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "R8ou9W",
                "created_at": "2023-05-29T01:57:12.000000Z",
                "updated_at": "2023-07-16T04:02:41.000000Z",
                "bank_account_name": "IDOKO MIRACLE ENE",
                "bank": "058",
                "bank_account_number": "0679818682",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_o3t6hole6i9xm7j",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 80,
                "firstName": "Mercy",
                "lastName": "Chiori",
                "email": "mercyleany2@gmail.com",
                "email_code": "6707",
                "email_verified": 1,
                "password": "$2y$10$nJlUJj\/QMYEMEBsndY4hdOF2FW2Gd2o6jJsAMT6caLOvDzH5NGEgi",
                "phone": "07031353725",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "hX6CNt",
                "created_at": "2023-05-29T02:11:39.000000Z",
                "updated_at": "2023-06-07T01:09:47.000000Z",
                "bank_account_name": "Mercy Oluchi Chiori",
                "bank": "044",
                "bank_account_number": "1472745673",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_29oasnwbyh54bwl",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 81,
                "firstName": "Sarah",
                "lastName": "Obaje",
                "email": "sarahobaje43@gmail.com",
                "email_code": "7000",
                "email_verified": 1,
                "password": "$2y$10$S4wRFyfekrBdOipkCoIhieDdSmHD.3k5S1TKstqKkFy5uiKLt9inS",
                "phone": "08051626438",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "czQ6Ho",
                "created_at": "2023-05-29T02:20:55.000000Z",
                "updated_at": "2023-05-29T07:06:24.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 82,
                "firstName": "Paul",
                "lastName": "Joel",
                "email": "pauljoeleduhya@gmail.com",
                "email_code": "5806",
                "email_verified": 1,
                "password": "$2y$10$VjcMjmSyiRizz3WRlLtnsuKjuRHaLIFSjiUtpfp9fA0uKtSCxFQ2O",
                "phone": "08134995245",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "OX1rf9",
                "created_at": "2023-05-29T02:27:31.000000Z",
                "updated_at": "2023-05-29T07:41:45.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 83,
                "firstName": "Jeremiah",
                "lastName": "ochowechi",
                "email": "slimzeey5@gmail.com",
                "email_code": "6931",
                "email_verified": 1,
                "password": "$2y$10$.E6ruSqoQ6xmR.9pBd2RYO2mb8R36IDjkasxnoSijNGrJfJGTF7si",
                "phone": "09158915049",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "wjRz64",
                "created_at": "2023-05-29T02:31:08.000000Z",
                "updated_at": "2023-05-29T09:07:10.000000Z",
                "bank_account_name": "JEREMIAH OCHOWECHI SIMON",
                "bank": "999992",
                "bank_account_number": "9158915049",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_jngckl7dyspgfmv",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 84,
                "firstName": "Samuel",
                "lastName": "Ayedun",
                "email": "samuelayodeji631@gmail.com",
                "email_code": "6251",
                "email_verified": 1,
                "password": "$2y$10$R2gh.P.Z8PtiEiQjhYudS.OUGfF3Tw.x63QROaYl5iQYw5vPLQixC",
                "phone": "09090044812",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "YpwP2L",
                "created_at": "2023-05-29T02:52:51.000000Z",
                "updated_at": "2023-09-17T06:12:54.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 85,
                "firstName": "chinedu",
                "lastName": "Uwaoma",
                "email": "uwaomachinedu90@gmail.com",
                "email_code": "5213",
                "email_verified": 1,
                "password": "$2y$10$H7I1QQVgGu99NLKvKu5kluCJadnGhSM9JAX7JRXU7s.yCdGxof\/Cq",
                "phone": "09042299145",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "1gY2AH",
                "created_at": "2023-05-29T02:58:51.000000Z",
                "updated_at": "2023-08-30T20:06:05.000000Z",
                "bank_account_name": "Uwaoma chinedu",
                "bank": "214",
                "bank_account_number": "1004715670",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_zf13y0mrijgwjs3",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 86,
                "firstName": "Emmanuel",
                "lastName": "Inuojo",
                "email": "coolemmyl@yahoo.co.uk",
                "email_code": "8555",
                "email_verified": 1,
                "password": "$2y$10$ws1AEUQsznbiEB7UvWfAn.OpQtEG2rYAyfVooXwP4kBHdYJ3qvX8G",
                "phone": "07031688609",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "F15E2X",
                "created_at": "2023-05-29T03:26:45.000000Z",
                "updated_at": "2023-06-23T09:13:14.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 87,
                "firstName": "Ndonna",
                "lastName": "Onyinye",
                "email": "ndonnaonyinye120@gmail.com",
                "email_code": "9555",
                "email_verified": 1,
                "password": "$2y$10$sTAFV0pwDGismaXIY6vjdeiwv3xrvqy2Oq86iLFHgnpuuSQuynAXu",
                "phone": "09074937190",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "kUzXfS",
                "created_at": "2023-05-29T03:43:39.000000Z",
                "updated_at": "2023-06-01T11:02:04.000000Z",
                "bank_account_name": "United bank Nigeria",
                "bank": "033",
                "bank_account_number": "2231664972",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_3eu986s8kynnhtl",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 88,
                "firstName": "Chidiume",
                "lastName": "Esther",
                "email": "estherchidiume3@gmail.com",
                "email_code": "7196",
                "email_verified": 1,
                "password": "$2y$10$LZqYQIQIuR6ezVT0PZ.Wq.\/jst2NtQ0XGAsk.Lj9dusJtEtyPYisO",
                "phone": "07031108598",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ADCqjz",
                "created_at": "2023-05-29T06:43:25.000000Z",
                "updated_at": "2023-05-29T17:06:31.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 89,
                "firstName": "Ifeoma",
                "lastName": "Edeh",
                "email": "ifeomapriscy@gmail.com",
                "email_code": "9156",
                "email_verified": 1,
                "password": "$2y$10$4lI42T3fEyCg79RpRghlcuLT3jMhlKZMwwY0cZm1qqSCR2uJLV.Xm",
                "phone": "08034349914",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "FK8p5I",
                "created_at": "2023-05-29T06:57:21.000000Z",
                "updated_at": "2023-05-29T19:35:21.000000Z",
                "bank_account_name": "First bank",
                "bank": "011",
                "bank_account_number": "3067997018",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_j0oyaxl81b0h2ou",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 90,
                "firstName": "Hikmat",
                "lastName": "abdullateef",
                "email": "hikmatomowumi3@gmail.com",
                "email_code": "7800",
                "email_verified": 1,
                "password": "$2y$10$vLHJ82niH0iHwjVPPPTZWuu.5nmuNj54kuHpHQTE2WUbcPBL\/nsxi",
                "phone": "09168216871",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "fQ4Hr9",
                "created_at": "2023-05-29T07:03:42.000000Z",
                "updated_at": "2023-05-29T07:09:59.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 91,
                "firstName": "Oni",
                "lastName": "Victor",
                "email": "oniv84939@gmail.com",
                "email_code": "2746",
                "email_verified": 1,
                "password": "$2y$10$vFJinbxPfa3VEm235A1beOJRi1dhrjzGtAah79B\/NCbhIqNZic3RW",
                "phone": "07066513841",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "CIVTQZ",
                "created_at": "2023-05-29T07:15:13.000000Z",
                "updated_at": "2023-11-05T00:41:28.000000Z",
                "bank_account_name": "Oni Funmilola Toyin",
                "bank": "011",
                "bank_account_number": "3045031215",
                "is_payed": "true",
                "total_aff_sales_cash": "50000",
                "total_aff_sales": "10",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_o3z3ui66i47qshj",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-30 07:41:36",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 93,
                "firstName": "Kingsley",
                "lastName": "Udo",
                "email": "kingsleyamos90@gmail.com",
                "email_code": "3355",
                "email_verified": 1,
                "password": "$2y$10$6tlQlUxScJ7bhGzRwk3gpOM1Ia1xBcWqVbY7Y2NeY\/Qam0Iaqb4Ke",
                "phone": "07031250552",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ziHnwJ",
                "created_at": "2023-05-29T08:04:10.000000Z",
                "updated_at": "2023-05-31T01:14:34.000000Z",
                "bank_account_name": "Kingsley udo Amos",
                "bank": "033",
                "bank_account_number": "2148196559",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ef14cf8gon8qmsz",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 94,
                "firstName": "Victoria",
                "lastName": "Awe",
                "email": "victoriaawe677@gmail.com",
                "email_code": "3454",
                "email_verified": 1,
                "password": "$2y$10$C9tI1NZNDAl0C6\/xYUhP.OnOh1J3PvuWfAXjUY07RTvDG7pTaBF..",
                "phone": "08101373044",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "moMuTE",
                "created_at": "2023-05-29T08:04:47.000000Z",
                "updated_at": "2023-07-23T07:48:07.000000Z",
                "bank_account_name": "Awe Idowu Victoria",
                "bank": "058",
                "bank_account_number": "0471347359",
                "is_payed": "true",
                "total_aff_sales_cash": "60000",
                "total_aff_sales": "12",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ujux1ppdmefdb9j",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-07-17 20:31:27",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 95,
                "firstName": "Victor",
                "lastName": "Benson",
                "email": "thbenson2015@gmail.com",
                "email_code": "1517",
                "email_verified": 1,
                "password": "$2y$10$JM1VkZy64IRjbxbUAct6FekpKuPdVcvdg.jNOqo42dC1sBc1.OD.m",
                "phone": "08167186076",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "kwTj2Y",
                "created_at": "2023-05-29T08:10:25.000000Z",
                "updated_at": "2023-06-23T01:43:59.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 96,
                "firstName": "Halima",
                "lastName": "Ahmed",
                "email": "halima.ajiboye2@gmail.com",
                "email_code": "7857",
                "email_verified": 1,
                "password": "$2y$10$OqmOYqcbASjafvXCmB1GcuWmKxd8UWKxbB7DPhRsVArBHk1ywQEUm",
                "phone": "08054136517",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "URE7Vm",
                "created_at": "2023-05-29T08:10:34.000000Z",
                "updated_at": "2023-08-10T13:19:38.000000Z",
                "bank_account_name": "Halima Ize Ahmed Ajiboye",
                "bank": "058",
                "bank_account_number": "0004346668",
                "is_payed": "true",
                "total_aff_sales_cash": "15000",
                "total_aff_sales": "3",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_1fire9f6575uwdf",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 97,
                "firstName": "Halima",
                "lastName": "Usman",
                "email": "usmanhalima2018@gmail.com",
                "email_code": "5645",
                "email_verified": 1,
                "password": "$2y$10$d74HbmUqkRv9XgtqfgSRc.siaWPyDUnXh8\/mUytv\/1DtVGcBB4LnK",
                "phone": "09020496419",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "4tceHB",
                "created_at": "2023-05-29T08:36:11.000000Z",
                "updated_at": "2023-07-02T01:56:18.000000Z",
                "bank_account_name": "Halima Usman",
                "bank": "033",
                "bank_account_number": "2228194004",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_hvp5n93vias03tq",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 98,
                "firstName": "Abdulsalam",
                "lastName": "jamal",
                "email": "oluwajamali0us19@gmail.com",
                "email_code": "7317",
                "email_verified": 1,
                "password": "$2y$10$FvsH33MoZCfxVRmlYDclWuGBKqYSlXMPusrr3FQMXFSjGbKezjQsW",
                "phone": "08067016525",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "sYJPu2",
                "created_at": "2023-05-29T08:49:22.000000Z",
                "updated_at": "2023-05-29T10:45:06.000000Z",
                "bank_account_name": "Jamal abdulsalam oluwaseun",
                "bank": "044",
                "bank_account_number": "0764344666",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_uynjph76p6v2kdm",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 99,
                "firstName": "Kind",
                "lastName": "Ettah",
                "email": "kindettah@gmail.com",
                "email_code": "1489",
                "email_verified": 1,
                "password": "$2y$10$xhHs8LWz\/3bj41QWe\/nP5uGNjAxBcQLN8b8A7q8pnMwpBpnh.3bgK",
                "phone": "07058242941",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "mxOTLz",
                "created_at": "2023-05-29T08:55:54.000000Z",
                "updated_at": "2023-05-29T09:29:22.000000Z",
                "bank_account_name": "Kind Ettah",
                "bank": "058",
                "bank_account_number": "0138549375",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_d6ykedvxmz34iez",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 100,
                "firstName": "Roseline",
                "lastName": "Ndukwe",
                "email": "akudondukwe4u@gmail.com",
                "email_code": "7104",
                "email_verified": 1,
                "password": "$2y$10$wERzAyq4obRzLCM.6gZOmORDQBrYprhviGA676\/k66gGyX1GA6ns.",
                "phone": "08034623406",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "hAMOw7",
                "created_at": "2023-05-29T09:12:26.000000Z",
                "updated_at": "2023-06-01T22:09:40.000000Z",
                "bank_account_name": "Akudo Roseline Ndukwe",
                "bank": "082",
                "bank_account_number": "6001870488",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_x63gskumcq138c5",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 101,
                "firstName": "Nebeh",
                "lastName": "Genevieve",
                "email": "chinaza698@gmail.com",
                "email_code": "5644",
                "email_verified": 1,
                "password": "$2y$10$trNLqAKdCNVLZBq8QV9YbOv0xomgVI9dNdCMyA7WbFjwS8TAzO5Xa",
                "phone": "08137327217",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "VYAQZ4",
                "created_at": "2023-05-29T09:27:54.000000Z",
                "updated_at": "2023-11-05T04:04:28.000000Z",
                "bank_account_name": "Nebeh Genevieve Chinaza",
                "bank": "070",
                "bank_account_number": "6172390719",
                "is_payed": "true",
                "total_aff_sales_cash": "225000",
                "total_aff_sales": "45",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_2pevawhc3ahi6nw",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-31 18:58:13",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 102,
                "firstName": "Israel",
                "lastName": "Iheanyichi",
                "email": "iheanyichi68israel@gmail.com",
                "email_code": "4632",
                "email_verified": 1,
                "password": "$2y$10$Zin0dpoWsDHbrmwlT3TWBOtp8RJvUP\/4FkAN1dKGpJWrC7ySg.bv6",
                "phone": "08035002500",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "LxY9tO",
                "created_at": "2023-05-29T09:36:41.000000Z",
                "updated_at": "2023-06-03T09:36:44.000000Z",
                "bank_account_name": "Israel Iheanyichi Israel",
                "bank": "058",
                "bank_account_number": "0043732611",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_q9lfg2658mzvcyr",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 103,
                "firstName": "Zaharaddeen",
                "lastName": "Maiyama",
                "email": "bldr.zlmaiyama@gmail.com",
                "email_code": "9553",
                "email_verified": 0,
                "password": "$2y$10$s.RqeHzcXaXmGMS89X3h1unyUIvXWJJTGvbHJ9QBm.2cutKc59tzK",
                "phone": "08064547459",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "nmijpR",
                "created_at": "2023-05-29T09:47:48.000000Z",
                "updated_at": "2023-05-29T09:47:48.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": null,
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 104,
                "firstName": "Favour",
                "lastName": "Emmanuel",
                "email": "wenduempire@gmail.com",
                "email_code": "7322",
                "email_verified": 1,
                "password": "$2y$10$HwDX0i\/2.jfSwEYLnkvsMukV5eYJhzrjpiP3dgilctlaD9ePqXnvu",
                "phone": "0903 507 4217",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "g0xhmC",
                "created_at": "2023-05-29T10:02:51.000000Z",
                "updated_at": "2023-06-18T00:41:43.000000Z",
                "bank_account_name": "Favour Azubuine Emmanuel FLW",
                "bank": "035",
                "bank_account_number": "7358388921",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_is8f536q5vgp4xi",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 105,
                "firstName": "Esther",
                "lastName": "Onakoya",
                "email": "onakoyaesther2003@gmail.com",
                "email_code": "3449",
                "email_verified": 1,
                "password": "$2y$10$WCQaLZSPVFFCkbpnHSK2iO.OSzkGmRfLKEm\/AitDxHr9nlv4Vz0x6",
                "phone": "07015341549",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "pm5GFS",
                "created_at": "2023-05-29T10:10:04.000000Z",
                "updated_at": "2023-05-29T10:25:52.000000Z",
                "bank_account_name": "Onakoya Esther Abiodun",
                "bank": "044",
                "bank_account_number": "0037214489",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_vufjc8viaiuiozf",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }]';


            $json = json_decode($json_d, true);

            if (!is_array($json)) {
                return response()->json(['message' => 'Invalid JSON data'], 400);
            }

            $count = count($json);
    
            foreach ($json as $data) {
                $id = $data['id'];
                $totalAffSalesCash = $data['total_aff_sales_cash'];

                $user = Members::find($data['id']);

                $user->total_aff_sales_cash = $totalAffSalesCash;

                $user->save();
    
                // Update the MySQL database column using Eloquent
               // Members::where('id', $id)->update(['total_aff_sales_cash' => $totalAffSalesCash]);
            }
    
            return response()->json(['message' => ' updated successfully   '.strval($count)], 200);
       





       });









    //temp code
    Route::get('test/koretsales', function () {
        $phone = "2348037482777";
        $pin = "0115";
        $activation_code = "123456";
        $rand = "83637728787";
        $url = "https://www.koretsales.com/api/signin";
        
        $response = Http::asForm()->post($url, [
            'phone' => $phone,
            'pin' => $pin,
            'activation_code' => $activation_code,
            'rand' => $rand
        ]);
        
        $statusCode = $response->status();
        $responseData = $response->json();
        
        // Handle the response as needed
        if ($statusCode === 200) {

            // Generate a unique file name
$fileName = 'data_' . Str::random(10) . '.csv';

// Create a new file in the storage directory
$filePath = storage_path('app/' . $fileName);

// Open the file in write mode
$file = fopen($filePath, 'w');


// Write the CSV header
$header = ['stock_id', 'name',"price","quantity","date_added"  ];
fputcsv($file, $header);

// Fetch data from the database or any other source

$data = array();

 // Successful response
           // return $responseData["data"]["stocks"];

foreach($responseData["data"]["stocks"] as $single_stock){

    array_push($data, array($single_stock["stock_id"], $single_stock["name"], $single_stock["price"], $single_stock["quantity"], $single_stock["date_added"]));

}


// Write the data rows to the CSV file
foreach ($data as $row) {
    fputcsv($file, $row);
}

// Close the file
fclose($file);

// Store the CSV file in a public directory (optional)
$publicPath = 'public/csv/' . $fileName;
Storage::disk('local')->put($publicPath, file_get_contents($filePath));

// Optionally, you can delete the temporary file
unlink($filePath);

// Return a response with the download link
$downloadLink = Storage::url($publicPath);





return response()->json(['download_link' => $downloadLink]);
           
        } else {
            // Error handling
            return response()->json(['error' => 'An error occurred.'], $statusCode);
        }
    });

    

    //get affiliates with pending payment

    Route::get('view/payable_affiliates', function () {

    $unpaid_affiliates = Members::where("is_vendor", false)
    ->where("payment_reference_paystack","!=",null)
    ->whereRaw("CAST(unpaid_balance AS UNSIGNED) > 200 ")
    ->where("withdrawal_settings", true)
   /* ->whereIn("email", [
        "nonsojoshua001@gmail.com",
        "aimchinaza3039@gmail.com",
        "johnadetunji92@gmail.com",
        "belovedprinz@gmail.com",
        "blessingochiemen01@gmail.com"
    ])*/
    ->get();

    // Generate a unique file name
$fileName = 'data_' . Str::random(10) . '.csv';

// Create a new file in the storage directory
$filePath = storage_path('app/' . $fileName);

// Open the file in write mode
$file = fopen($filePath, 'w');

// Write the CSV header
$header = ['Account Number', 'Bank', 'Amount', 'Narration'];
fputcsv($file, $header);

// Fetch data from the database or any other source

$data = array();

foreach($unpaid_affiliates as $unpaid_affiliate){

    array_push($data, array($unpaid_affiliate->bank_account_number, $unpaid_affiliate->bank, $unpaid_affiliate->unpaid_balance,"ZENITHSTAKE ENTERPRISE - ".$unpaid_affiliate->firstName));

}


// Write the data rows to the CSV file
foreach ($data as $row) {
    fputcsv($file, $row);
}

// Close the file
fclose($file);

// Store the CSV file in a public directory (optional)
$publicPath = 'public/csv/' . $fileName;
Storage::disk('local')->put($publicPath, file_get_contents($filePath));

// Optionally, you can delete the temporary file
unlink($filePath);

// Return a response with the download link
$downloadLink = Storage::url($publicPath);





return response()->json(['download_link' => $downloadLink,"unpaid_affiliates" => $unpaid_affiliates]);


   // return response()->json($unpaid_affiliates );

    });


    Route::get('view/all', 'show');




  //retrieve affiliates , order by total unpaid balance

Route::get('view/affiliates/order', function () {
    $affiliates = Members::orderBy('unpaid_balance', 'desc')->get();
    
    return response()->json($affiliates);
});




    Route::get('view/affiliates', function () {
        $affiliates = Members::where('is_vendor', false)
        ->orderByDesc('created_at')
        ->get();
    
        return response()->json( $affiliates);
    });

    Route::get('view/affiliates/total', function () {
        $affiliates = Members::where('is_vendor', false)
           // ->orderByDesc('created_at')
            ->where("id","!=",507)
            ->get();
    
        $sumTotalAffCash = 0;
        $sumTotalAff = 0;
        foreach ($affiliates as $affiliate) {
            $totalAffCash = intval($affiliate->total_aff_sales_cash);
            $totalAff = intval($affiliate->total_aff_sales);
            $sumTotalAffCash += $totalAffCash;
            $sumTotalAff +=$totalAff ;
        }
    
        return response()->json([
            'affiliates' => count($affiliates),
            'sum_total_aff_cash' => $sumTotalAffCash,
            'sum_total_aff_sales'=> $sumTotalAff,
        ]);
    });

    Route::get('view/vendors', function () {
        $vendors = Members::where('is_vendor', true)
        ->orderByDesc('created_at')
        ->get();
    
        return response()->json( $vendors);
    });




    Route::get('view/user/{id}', function ($id) {
        $user = Members::find($id);
    
        return response()->json($user);
    });

    Route::get('user/update_vendor/{id}', function ($id) {
        $vendor = Members::findOrFail($id); // Find the vendor by ID
        $vendor->is_vendor = false; // Set the status to true
        $vendor->save(); // Save the changes to the database
        return response()->json(["message" => "successfully updated"]);
    });


    Route::get('users/all/update_all_earnings', function () {
       // Members::query()->update(['is_payed' => ]);



       Members::query()->update(['unpaid_balance' => "0.00"]);
       Members::query()->update(['unpaid_balance_vendor' => "0.00"]);
       Members::query()->update(['total_aff_sales_cash' => "0.00"]);
       Members::query()->update(['total_aff_sales' => "0.00"]);
       Members::query()->update(['total_vendor_sales_cash' => "0.00"]);
       Members::query()->update(['total_vendor_sales' => "0.00"]);

       return response()->json(["message" => "successfully updated"]);
    });

    Route::get('account/remove/{id}', function ($id) {
        $user = Members::destroy($id);

        return response()->json(["message" => "successfully deleted"]);
    });

    Route::post('member/update','update');

    Route::get('member/update_withdrawal/{id}', function ($id) {
        $user = Members::findOrFail($id);
    
    // Toggle the withdrawal_setting value
    $user->withdrawal_settings = !$user->withdrawal_settings;
    $user->save();

    return response()->json(["message" => "Withdrawal setting updated successfully"]);

    });

   

    Route::post('member/update_profile_admin','update_profile_admin_affiliate');

      Route::post('member/update_profile_admin_vendor','update_profile_admin_vendor');

    Route::post('account/verify_code','verify_code');
    Route::post('account/change_password','change_password');

    Route::post('account/confirm_email','send_mail_verify_code');

    Route::post('account/verify_email','verify_email_with_code');


    //verify email from admin
    Route::get('update_email_verified/{id}', function ($id) {
        // Find the user by ID
        $user = Members::find($id);
    
        if ($user) {
            // Update the email_verified column to true
          //  $user->update(['email_verified' => true]);

            $user->email_verified = true;
            $user->save();
    
            return response()->json(['message' => 'Email verification status updated successfully']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    });

   

    
   
  
   // Route::middleware('auth:sanctum')-> post('set_transaction_pin','set_transaction_pin');
   
   // Route::get('test_api','test_api');
});
//Vendors queries

Route::controller(VendorsController::class)->group(function(){

    Route::post('vendors/create','store');
   
   // Route::middleware('auth:sanctum')-> post('set_transaction_pin','set_transaction_pin');
   
   // Route::get('test_api','test_api');

   Route::get('view/vendor/{id}', function ($id) {
    $user = Vendors::where('vendor_id', $id)->get();

    return response()->json($user);
});




Route::get('vendors/view', function () {
    $vendors = Vendors::all();



    for($i=0; $i < count($vendors); $i++){

        $user = Members::find($vendors[$i]['vendor_id']);

        $vendors[$i]['vendor_details'] = $user;
        $vendors[$i]["image_path"] = asset('https://back.zenithstake.com/storage/images/vendor_images/' . $vendors[$i]["image"]);

    }

    return response()->json($vendors);
});




Route::get('vendors/top/view', function () {
    $vendors = Vendors::all();

    foreach ($vendors as $vendor) {
        $salesCount = Sales::where('vendor_id', $vendor->vendor_id)->count();
        $vendor->sales_count = $salesCount;

        $user = Members::where('is_payed', "true")
                         ->where("id",$vendor->vendor_id)->get();
        $vendor["vendor_details"] = $user;
        $vendor->image_path = asset('https://back.zenithstake.com/storage/images/vendor_images/' . $vendor->image);
    }

    // Sort vendors based on sales_count in descending order
    $vendors = $vendors->sortByDesc('sales_count')->values();

    // Limit the number of results to two
    $limitedVendors = $vendors->take(2);

    return response()->json($limitedVendors);
});




});

Route::controller(ProductsController::class)->group(function(){
  
    Route::post('products/add','store');
    Route::get('products/view/{count}','show');
   // Route::middleware('auth:sanctum')-> post('set_transaction_pin','set_transaction_pin');
   
   // Route::get('test_api','test_api');

   Route::get('update/product/{id}', function ($id) {
    // Get the product by ID
    $product = Products::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Update the sales_page column
    $product->productSalesPageLink = 'https://zenithstake.com/smac/smac';
   // $product->vendor_id = "54";
    //$product->productCommission ="50";

    $product->save();

    return response()->json(['message' => 'Product sales page updated successfully']);
});

Route::get('approve/product/{id}', function ($id) {
    // Get the product by ID
    $product = Products::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Update the sales_page column
    $product->approved = true;
    $product->approved_date = Carbon::now();
   
    $product->save();

    return response()->json(['message' => 'Product sales page updated successfully']);
});

Route::get('disable/product/{id}', function ($id) {
    // Get the product by ID
    $product = Products::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Update the sales_page column
    $product->approved = false;
    $product->approved_date = null;
   
    $product->save();

    return response()->json(['message' => 'Product sales page updated successfully']);
});

//get products from vendors

Route::get('view/vendor_products/{vendor_id}', function ($vendor_id) {

    $vendor_products = Products::where('vendor_id', $vendor_id)->get();

    return response()->json($vendor_products);


});

Route::get('view/product/{id}', function ($id) {

    $product = Products::find($id);

    return response()->json($product);


});




});


Route::controller(BanksController::class)->group(function(){
  
    Route::post('banks/add_nigerian_banks','addNigerianBanks');

    Route::post('banks/add_ghana_banks','addGhanaBanks');

    
    Route::get('banks/view','show');

    Route::get('banks/view/gh','show_ghana');

    Route::get('banks/view/ng','show_nigeria');
  
});

Route::controller(SalesController::class)->group(function(){
  
    Route::post('sales/test_email','testemail');
    Route::post('sales/add','store');
    Route::get('sales/view','show');
    Route::get('view/sale/{id}', function ($id) {
        $sale = Sales::find($id);
    
        return response()->json($sale);
    });


    //get affiliate_sales in last 24 hours

    Route::get('sales/today/affiliate/{affiliate_id}', function ($affiliate_id) {
        $startDateTime = Carbon::today(); // Get the start of today (12am)
        $endDateTime = Carbon::now(); // Get the current date and time
    
        $sales = Sales::where('affiliate_id', $affiliate_id)
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->get();
    
        return response()->json($sales);
    });


    //get sales between dates



    Route::get('sales/get_sales_dates', function (Request $request) {
        // Get the start date and end date from query parameters
        $startDate = '2023-09-08';

        $endDate = '2023-09-19';
    
        // Validate if start_date and end_date are provided and in valid date format
        if (!$startDate || !$endDate || !Carbon::parse($startDate) || !Carbon::parse($endDate)) {
            return response()->json(['error' => 'Invalid start_date or end_date format'], 400);
        }
    
        // Parse the dates to Carbon instances
        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();
    
        // Query the sales records between the provided dates
        $sales = Sales::whereBetween('created_at', [$startDateTime, $endDateTime])->get();


                // Generate a unique file name
        $fileName = 'data_' . Str::random(10) . '.csv';

        // Create a new file in the storage directory
        $filePath = storage_path('app/' . $fileName);

        // Open the file in write mode
        $file = fopen($filePath, 'w');


        // Write the CSV header
        $header = ['sale_id', 'c_name',"c_email","c_phone","date_added"  ];
        fputcsv($file, $header);

        // Fetch data from the database or any other source

        $data = array();

        // Successful response
                // return $responseData["data"]["stocks"];

        foreach($sales as $sale){

            array_push($data, array($sale["id"], $sale["customer_name"], $sale["customer_email"], $sale["customer_phone"], $sale["created_at"]));

            try {
                if(Mail::to($sale["customer_email"])->send(new MessageEmail($sale["customer_email"]))){

                    /// return true;
         
                 }
            } catch (\Swift_TransportException $e) {
                // Log the error for debugging
                Log::error('Mailgun Error: ' . $e->getMessage());

                print('Mailgun Error: ' . $e->getMessage());
                // Handle the error gracefully, e.g., notify the user
            }
            
            
            
            
           

        }


        // Write the data rows to the CSV file
        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        // Close the file
        fclose($file);

        // Store the CSV file in a public directory (optional)
        $publicPath = 'public/csv/' . $fileName;
        Storage::disk('local')->put($publicPath, file_get_contents($filePath));

        // Optionally, you can delete the temporary file
        unlink($filePath);

        // Return a response with the download link
        $downloadLink = Storage::url($publicPath);

    
        return response()->json(array("csv"=>$publicPath,"sales"=>$downloadLink));
    });
    

    //get vendor sales in last 24 hours

    Route::get('sales/today/vendor/{vendor_id}', function ($vendor_id) {
        $startDateTime = Carbon::today(); // Get the start of today (12am)
        $endDateTime = Carbon::now(); // Get the current date and time
    
        $sales = Sales::where('vendor_id', $vendor_id)
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->get();
    
        return response()->json($sales);
    });

    //get sales from affiliate with dates filter

    Route::post('view/sales/affiliate','show_affiliate_sales_from_date');

    Route::post('view/sales/vendor','show_vendor_sales_from_date');

    Route::post('view/sales/vendor/as_affiliates','show_vendor_sales_from_date_as_affiliates');


    Route::get('view/user_sales_count/{id}', function ($id) {
        $sales_by_user = Sales::where('affiliate_id', $id)->get();

        $total_sales = 0;

        foreach( $sales_by_user as $sale){

            $commision = intval($sale->commission);
            $product_price = intval($sale->product_price);

            $income = ($commision/100)*$product_price ;
            $total_sales  =  $total_sales  + $income;
        }
       
        return response()->json(["count"=>count( $sales_by_user ), "aff"=>$id, "total_sales"=>strval($total_sales)]);
    });

// Get top 5 affiliates with the highest number of sales for a product within the current month
Route::get('top_affiliate/product/view/{product_id}', function ($product_id) {
    $firstDayOfMonth = now()->firstOfMonth();
    $current = now();

   /* $top_affiliates = Sales::where('product_id', $product_id)
        ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth]) // Filter sales for the current month
        ->selectRaw('affiliate_id, count(*) as sales_count')
        ->groupBy('affiliate_id')
        ->orderBy('sales_count', 'desc')
        ->take(10) // Retrieve the top 5 affiliates
        ->get();

    // Retrieve affiliate details for each of the top affiliates
    foreach ($top_affiliates as $index => $affiliate) {
        $user = Members::where('affiliate_id', $affiliate->affiliate_id)->first();
        $top_affiliates[$index]->firstName = $user->firstName;
        $top_affiliates[$index]->lastName = $user->lastName;
    }*/


    $query = Sales::where('vendor_id', '16')
    ->selectRaw('sales.affiliate_id, COUNT(*) as count, members.*')
    ->join('members', 'members.affiliate_id', '=', 'sales.affiliate_id')
    ->groupBy('sales.affiliate_id', 'members.id', 'members.affiliate_id')
    ->where('sales.created_at', '>=', ($firstDayOfMonth))
    ->where('sales.created_at', '<=', $current)
    ->limit(10);


$sales_by_user = $query->orderBy('count', 'desc')->get();

return response()->json( $sales_by_user);


  //  return response()->json($top_affiliates);
});



    //get top affiliates for a vendor
    Route::get('top_affiliate/view/{vendor_id}', function ($vendor_id) {
        $top_affiliates = Sales::where('vendor_id', $vendor_id)->get();
    
        for($i=0; $i < count($top_affiliates); $i++){
    
            $user = Members::find($top_affiliates[$i]['affiliate_id']);
    
            $top_affiliates[$i]['affiliate_details'] = $user;
          //$vendors[$i]["image_path"] = asset('https://zenithstake.syncight.com/storage/images/vendor_images/' . $vendors[$i]["image"]);
    
        }
    
        return response()->json( $top_affiliates);
    });

    //vendor sales

    Route::get('view/vendor/sales/{vendor_id}', function ($vendor_id) {
        $vendor_sales = Sales::where('vendor_id', $vendor_id)->get();

        $total_sales = 0;

        foreach( $vendor_sales as $sale){

            $price = intval($sale->product_price);
            $product_price = intval($sale->product_price);
            $commision = intval($sale->commission);

            $aff_commission = ($commision/100)*$product_price ;

            $vendor_income = $price - $aff_commission;

            $total_sales  =  $total_sales  +  $vendor_income;
        }

        
    
        return response()->json($vendor_sales);
    });

    
  
});

//get vendor affiliates

Route::get('view/affiliates/{vendor_id}', function ($vendor_id) {

    $sales = Sales::where('vendor_id', $vendor_id)
    ->selectRaw('sales.affiliate_id, COUNT(*) as count, members.*')
    ->join('members', 'members.affiliate_id', '=', 'sales.affiliate_id')
    ->groupBy('sales.affiliate_id', 'members.id', 'members.affiliate_id')
    ->limit(200)
    ->get();


            return response()->json($sales);


});

Route::get('sales/today/unique', function () {

    $sales = Sales::all();

    $total_sales = 0;

    $total_revenue = 0;

    foreach($sales as $sale){
        $total_sales += intval($sale->product_price);


    }

    $startDateTime = Carbon::today(); // Get the start of today (12am)
        $endDateTime = Carbon::now(); // Get the current date and time
    
        $sales_today = Sales::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->get();


            $total_earnings_today = 0;
            foreach($sales_today as $sale_today){
                $total_earnings_today  += intval($sale_today->product_price);
            }
    
    return response()->json(["total_earnings"=>$total_sales,"sales_today"=>count($sales_today),"total_earnings_today"=>$total_earnings_today]);


});

Route::get('sales/today/unique', function () {

    $sales = Sales::all();

    $total_sales = 0;
    $total_revenue = 0;

    // Create an array to store unique customer emails
    $uniqueEmails = [];

    foreach($sales as $sale) {
        $total_sales += intval($sale->product_price);

        // Get the customer email for this sale
        $customerEmail = $sale->customer_email;

        // Check if the email is not in the uniqueEmails array
        if (in_array($customerEmail, $uniqueEmails)) {
            // Email is unique, add it to the array
            $uniqueEmails[] = $customerEmail;
        }
    }

    $startDateTime = Carbon::today(); // Get the start of today (12am)
    $endDateTime = Carbon::now(); // Get the current date and time

    $sales_today = Sales::whereBetween('created_at', [$startDateTime, $endDateTime])->get();

    $total_earnings_today = 0;

    foreach($sales_today as $sale_today) {
        $total_earnings_today  += intval($sale_today->product_price);
    }

    return response()->json([
        "total_earnings" => $total_sales,
        "sales_today" => count($sales_today),
        "total_earnings_today" => $total_earnings_today,
        "unique_customer_emails" => $uniqueEmails
    ]);

});




Route::get('admin_sales/view', function () {

    $sales = Sales::all();

    $total_sales = 0;

    $total_revenue = 0;

    foreach($sales as $sale){
        $total_sales += intval($sale->product_price);


    }

    $startDateTime = Carbon::today(); // Get the start of today (12am)
        $endDateTime = Carbon::now(); // Get the current date and time
    
        $sales_today = Sales::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->get();


            $total_earnings_today = 0;
            foreach($sales_today as $sale_today){
                $total_earnings_today  += intval($sale_today->product_price);
        
        
            }
    


    return response()->json(["total_earnings"=>$total_sales,"sales_today"=>count($sales_today),"total_earnings_today"=>$total_earnings_today]);


});






