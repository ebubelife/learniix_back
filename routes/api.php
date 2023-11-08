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
                "id": 106,
                "firstName": "Tochi",
                "lastName": "Onukwufor",
                "email": "onyekachitochi1@gmail.com",
                "email_code": "5850",
                "email_verified": 0,
                "password": "$2y$10$S3rNbv10jT44S.gb4md6uu60o1TlX8tEHNxulxHWBRgDwG1xPZLcO",
                "phone": "07034298685",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "PY6em4",
                "created_at": "2023-05-29T10:23:41.000000Z",
                "updated_at": "2023-07-27T12:52:06.000000Z",
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
                "id": 107,
                "firstName": "Saheed",
                "lastName": "Mubarak",
                "email": "mubawwal33@gmail.com",
                "email_code": "5296",
                "email_verified": 1,
                "password": "$2y$10$u5B1UBdev8\/qg6dEYGJYB.MmAqoUVG3bGIdNzRPxgltM\/wdQzHRrK",
                "phone": "08162182338",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "N6h1xp",
                "created_at": "2023-05-29T10:33:33.000000Z",
                "updated_at": "2023-05-31T16:00:14.000000Z",
                "bank_account_name": "Saheed Mubarak Bolaji",
                "bank": "058",
                "bank_account_number": "0126295451",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_if0letmowvy472a",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 108,
                "firstName": "John",
                "lastName": "Eloi",
                "email": "johnlinnnaemeka@gmail.com",
                "email_code": "9754",
                "email_verified": 1,
                "password": "$2y$10$\/H8OdEXVFdun6n7CzAAWhuJWjLDXhkrNzOM6Mt\/EvRC4oJNbI9l7m",
                "phone": "09034742720",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ZSltqK",
                "created_at": "2023-05-29T10:51:32.000000Z",
                "updated_at": "2023-07-09T06:50:38.000000Z",
                "bank_account_name": "John Nnaemeka Eloi",
                "bank": "057",
                "bank_account_number": "2214420328",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_4h5uq586z307wb7",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 109,
                "firstName": "Olapade opeyemi",
                "lastName": "fausat",
                "email": "olapadeopeyemi50@gmail.com",
                "email_code": "4598",
                "email_verified": 1,
                "password": "$2y$10$SpJLfw.\/Xc.lvmkiZD4yDOVaOvaHbKMaF4bKGD0KKOCtT1N8Vk2LW",
                "phone": "08025949354",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "1tcCih",
                "created_at": "2023-05-29T10:56:30.000000Z",
                "updated_at": "2023-05-30T14:28:06.000000Z",
                "bank_account_name": "Olapade opeyemi fausat",
                "bank": "063",
                "bank_account_number": "1223271299",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ygv14zv5d1jzzle",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 110,
                "firstName": "Onuchukwu",
                "lastName": "Chioma",
                "email": "winnerchioma74@gmail.com",
                "email_code": "1401",
                "email_verified": 1,
                "password": "$2y$10$Cv8WY.xOSsX2A41OQf43z.DuBk\/8bEGlNxZqmilGSTihPCITsLUym",
                "phone": "09010292298",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "WjpJ08",
                "created_at": "2023-05-29T11:40:11.000000Z",
                "updated_at": "2023-06-02T09:36:08.000000Z",
                "bank_account_name": "Onuchukwu Chioma winner",
                "bank": "999991",
                "bank_account_number": "9010292298",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_krfpn5a1qscn6l3",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 111,
                "firstName": "Maryann",
                "lastName": "Chidimma Nweke",
                "email": "nwekechidimma72@gmail.com",
                "email_code": "5686",
                "email_verified": 1,
                "password": "$2y$10$BZxFoaSVCrUdI0cmdaypguznvZcGUESq5gZ2EAVM0.kjJ50sWPuVa",
                "phone": "09015890420",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "hDj7OA",
                "created_at": "2023-05-29T11:46:24.000000Z",
                "updated_at": "2023-06-09T18:37:33.000000Z",
                "bank_account_name": "Maryann Chidimma Nweke",
                "bank": "063",
                "bank_account_number": "1441167352",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_c2owz6fkkitpd4u",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 112,
                "firstName": "Victor",
                "lastName": "Chinaza",
                "email": "nwachukwuvictor216655@gmail.com",
                "email_code": "6582",
                "email_verified": 1,
                "password": "$2y$10$TdSxZYtl0l1OqcH55KpPd.jSFIRbeXpyrodd.u4XNkhC\/nRoiG1e2",
                "phone": "08146636793",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "hrNdV8",
                "created_at": "2023-05-29T12:20:36.000000Z",
                "updated_at": "2023-10-28T23:55:39.000000Z",
                "bank_account_name": "Nwachukwu Victor Chinaza",
                "bank": "035",
                "bank_account_number": "8962777662",
                "is_payed": "true",
                "total_aff_sales_cash": "85000",
                "total_aff_sales": "17",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_fp7qow4gfplttyq",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-12 03:50:48",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 113,
                "firstName": "Henry",
                "lastName": "Ebube",
                "email": "henryebube09@gmail.com",
                "email_code": "2377",
                "email_verified": 1,
                "password": "$2y$10$OMSp7tPYBgr6gOcMFUx8g.52VYGnWl9z6UO87b7yO1uEjVhoS707u",
                "phone": "09031569231",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "J3D5sg",
                "created_at": "2023-05-29T12:44:06.000000Z",
                "updated_at": "2023-06-24T23:59:52.000000Z",
                "bank_account_name": "Onwuchuruba ebube",
                "bank": "011",
                "bank_account_number": "3190958270",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_x0bzddsggw7cdau",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 114,
                "firstName": "Oyedotun",
                "lastName": "Hannah Oyepeju",
                "email": "oyedotunh5@gmail.com",
                "email_code": "9314",
                "email_verified": 1,
                "password": "$2y$10$CQI3hh9Y33PAm\/AdH9JyG.XRBs5FluDih.QGKNyWCc\/f5c3qmj77C",
                "phone": "08166547294",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "l3VFiX",
                "created_at": "2023-05-29T13:00:32.000000Z",
                "updated_at": "2023-05-29T16:28:34.000000Z",
                "bank_account_name": "Oyedotun Hannah Oyepeju",
                "bank": "044",
                "bank_account_number": "1381387247",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_om7vvslblskne42",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 115,
                "firstName": "Purabi",
                "lastName": "Uhiara",
                "email": "uhiarapurabi@gmail.com",
                "email_code": "3250",
                "email_verified": 1,
                "password": "$2y$10$RrjomjCwTCrXJSmiwTPX2OU02rAjod8uy9mAiiTZJbi8PoIRfmy3K",
                "phone": "07032200141",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Tgwd4W",
                "created_at": "2023-05-29T13:06:41.000000Z",
                "updated_at": "2023-09-05T14:59:05.000000Z",
                "bank_account_name": "OBEWE PURABI IJEOMA",
                "bank": "033",
                "bank_account_number": "2263854914",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_351af77realdfb6",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 116,
                "firstName": "Atim",
                "lastName": "Abba Kaka",
                "email": "kakaabba268@gmail.com",
                "email_code": "6149",
                "email_verified": 1,
                "password": "$2y$10$5sMK4WlBwz3PxTR85cNMAux.IOXEU498KDm2EzDIYt6cKYl8o1H0e",
                "phone": "07081799604",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "7r6fdA",
                "created_at": "2023-05-29T13:33:48.000000Z",
                "updated_at": "2023-05-30T02:01:19.000000Z",
                "bank_account_name": "Abba kaka Atim",
                "bank": "044",
                "bank_account_number": "0691601546",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_6n2yqh03slfw05k",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 117,
                "firstName": "Ejiola",
                "lastName": "Praise",
                "email": "praiseomotolani22@gmail.com",
                "email_code": "3829",
                "email_verified": 1,
                "password": "$2y$10$uVcBGa0dIRh55QtPTMTexeQI0549SU3YHZwoYxfcJCXCNPxT.VEPy",
                "phone": "08063307463",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "YsJjCz",
                "created_at": "2023-05-29T14:16:21.000000Z",
                "updated_at": "2023-05-29T16:49:47.000000Z",
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
                "id": 118,
                "firstName": "IYAOMOLERE",
                "lastName": "OLUWAFUNMILOLA",
                "email": "zenolufunmi04@gmail.com",
                "email_code": "1169",
                "email_verified": 1,
                "password": "$2y$10$Lx0XUe86l85kH2VdpyVRMu\/aVfCeXABsmVLk0O4iEZPTz.crQC5Mi",
                "phone": "07013045457",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ALuUgl",
                "created_at": "2023-05-29T14:20:28.000000Z",
                "updated_at": "2023-05-30T17:02:30.000000Z",
                "bank_account_name": "IYAOMOLERE OLUWAFUNMILOLA CHRISTINE",
                "bank": "011",
                "bank_account_number": "3163989254",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_9r5bxjbicgxuult",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 119,
                "firstName": "Senge",
                "lastName": "Holly",
                "email": "hollysenge@gmail.com",
                "email_code": "5320",
                "email_verified": 1,
                "password": "$2y$10$6TfkCgRjoa2NGpmGxM0wDOQotC3S1Yi0FCkm\/ioMMcCfDqXyVn5eG",
                "phone": "08139035662",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "rB65jL",
                "created_at": "2023-05-29T14:22:57.000000Z",
                "updated_at": "2023-05-29T15:51:11.000000Z",
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
                "id": 120,
                "firstName": "umeh",
                "lastName": "chinonye",
                "email": "09078222ang@gmail.com",
                "email_code": "4964",
                "email_verified": 1,
                "password": "$2y$10$kcmYkH9aOlueTue9SZ2.DOj.Rwjb4de7\/J6pmj145v\/d8xV59uBge",
                "phone": "09078222831",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "1SJiWo",
                "created_at": "2023-05-29T14:37:37.000000Z",
                "updated_at": "2023-07-24T20:12:07.000000Z",
                "bank_account_name": "Umeh chinonye angela",
                "bank": "057",
                "bank_account_number": "2214314625",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_re20vgirccp45nq",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 121,
                "firstName": "Nwajiuba",
                "lastName": "Chidimma",
                "email": "jl0005057@gmail.com",
                "email_code": "7440",
                "email_verified": 1,
                "password": "$2y$10$5Ff32DXjnJeKVWxAmknwNuy3aIaJMaDQmqeu0lwOD9IhDwfhv\/fcG",
                "phone": "09032415783",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "WJFtVe",
                "created_at": "2023-05-29T14:53:52.000000Z",
                "updated_at": "2023-06-15T12:19:32.000000Z",
                "bank_account_name": "Fidelity",
                "bank": "070",
                "bank_account_number": "6322847609",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_4vd64mandwnd3nn",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 122,
                "firstName": "MUBARAK",
                "lastName": "ABDULGANIYU",
                "email": "mubarakabdulganiyu5@gmail.com",
                "email_code": "7765",
                "email_verified": 1,
                "password": "$2y$10$PYgB.PLYrPUZ7WVn21XzAu2HOkUAePFlJc.jvZj6ZHIspOpwQVG5i",
                "phone": "07063924543",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "0Jyb6v",
                "created_at": "2023-05-29T15:06:31.000000Z",
                "updated_at": "2023-05-29T15:53:32.000000Z",
                "bank_account_name": "MUBARAK AMAO ABDULGANIYU",
                "bank": "999992",
                "bank_account_number": "7063924543",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ocrt7akcpcqt4nc",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 123,
                "firstName": "Mercy",
                "lastName": "Olaosebikan",
                "email": "mercyinumidun18@gmail.com",
                "email_code": "8478",
                "email_verified": 1,
                "password": "$2y$10$7Wqi\/QKN.B2TISkm3iJGoe1CeFpbciyKgo396Q\/uJGmtTfm.bj24S",
                "phone": "08147550953",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "CkH9gf",
                "created_at": "2023-05-29T15:20:42.000000Z",
                "updated_at": "2023-10-23T21:24:47.000000Z",
                "bank_account_name": "Olaosebikan Mercy Oluwabusayomi",
                "bank": "058",
                "bank_account_number": "0167383513",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_cndqemh1mnupaw0",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 124,
                "firstName": "Emmanuella",
                "lastName": "Ojukwu",
                "email": "williamsigboecheonwu@gmail.com",
                "email_code": "9124",
                "email_verified": 1,
                "password": "$2y$10$2U.FcbAACkdaD3ljvVvmOuaBV5J0Ppx8X0ahJA0FUWU9b\/.Lvnrk.",
                "phone": "08162291114",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "5YtLPy",
                "created_at": "2023-05-29T15:25:07.000000Z",
                "updated_at": "2023-08-06T07:54:24.000000Z",
                "bank_account_name": "Williams Chiedoziem Igboecheonwu",
                "bank": "033",
                "bank_account_number": "2268558736",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_937p67h7ng2lywk",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-07-30 06:51:02",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 125,
                "firstName": "Patricia",
                "lastName": "Ogochukwu",
                "email": "ogochukwupatriciaohakamma@gmail.com",
                "email_code": "5636",
                "email_verified": 1,
                "password": "$2y$10$F4ghRCiGk6Nhd5doCwntAuHEc9fZfPnkYZ36x0LoIcoiERMgVM8hC",
                "phone": "09032279949",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "VFxy8I",
                "created_at": "2023-05-29T15:27:22.000000Z",
                "updated_at": "2023-05-29T15:51:57.000000Z",
                "bank_account_name": "Patricia Ogochukwu Ohakamma",
                "bank": "033",
                "bank_account_number": "2303631732",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_71bs5cslsrwmaqp",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 126,
                "firstName": "Chidmma",
                "lastName": "Nnabugo",
                "email": "nnabugomary1@gmail.com",
                "email_code": "1392",
                "email_verified": 1,
                "password": "$2y$10$AQwPoGBR4WXGA3KR2RjXCO4KcKpb3gKUgwwTy6JhLD8YmQH4Lwrgy",
                "phone": "07032696590",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "pJZtFc",
                "created_at": "2023-05-29T15:41:41.000000Z",
                "updated_at": "2023-11-05T22:31:52.000000Z",
                "bank_account_name": "Chidimma Nnabugo Constance",
                "bank": "011",
                "bank_account_number": "3021273541",
                "is_payed": "true",
                "total_aff_sales_cash": "55000",
                "total_aff_sales": "11",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "5000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_h9zzx55evqabmhk",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-05 22:31:52",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 127,
                "firstName": "Okpara",
                "lastName": "Juliet",
                "email": "uzomajulietokpala@gmail.com",
                "email_code": "7929",
                "email_verified": 1,
                "password": "$2y$10$\/JoHXk3NvDmzo1Q09d.LjO6febpild2NbsVLqwQK7Sc\/ymmkpbDOW",
                "phone": "09066880119",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "nDRfut",
                "created_at": "2023-05-29T15:43:45.000000Z",
                "updated_at": "2023-11-07T20:13:16.000000Z",
                "bank_account_name": "Okpara Juliet Uzoma",
                "bank": "057",
                "bank_account_number": "2282985002",
                "is_payed": "true",
                "total_aff_sales_cash": "1105000",
                "total_aff_sales": "221",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "105000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_b76hur0eeh5mxng",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-07 20:13:16",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 128,
                "firstName": "Adamu",
                "lastName": "Hussaini",
                "email": "adamubrowser@gmail.com",
                "email_code": "2485",
                "email_verified": 0,
                "password": "$2y$10$rgA6fK\/CMmmkJAFiqBLp2euIXhtjvNhVr1ocrZ1I1pfgu460DkbE6",
                "phone": "08031108616",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "h7Zgui",
                "created_at": "2023-05-29T15:51:18.000000Z",
                "updated_at": "2023-05-29T15:51:18.000000Z",
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
                "id": 129,
                "firstName": "John",
                "lastName": "Amarachi",
                "email": "johnamarachi05@gmail.com",
                "email_code": "1911",
                "email_verified": 1,
                "password": "$2y$10$91.9HRTb6HZBAF.LMc7RIu4tP3x9u293D3jdVcWFC3.xFPlvUPOgi",
                "phone": "09056828469",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "wcSATG",
                "created_at": "2023-05-29T16:04:36.000000Z",
                "updated_at": "2023-05-29T16:20:38.000000Z",
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
                "id": 131,
                "firstName": "Anijunsi",
                "lastName": "Christopher. C",
                "email": "chumaani22@gmail.com",
                "email_code": "5260",
                "email_verified": 1,
                "password": "$2y$10$5ij6V4g4Cd4yRa2mqYE92O1IErZA8KMJ8N\/jwi0lWVVEbbL6lH6B6",
                "phone": "09159523303",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "DbUIoW",
                "created_at": "2023-05-29T16:23:53.000000Z",
                "updated_at": "2023-05-29T16:57:37.000000Z",
                "bank_account_name": "Anijunsi Christopher",
                "bank": "011",
                "bank_account_number": "3052609836",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_viy966zoj2bp1be",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 132,
                "firstName": "Aliman",
                "lastName": "Mohammed",
                "email": "alimanmohammed228@gmail.com",
                "email_code": "2605",
                "email_verified": 1,
                "password": "$2y$10$byx6uyupB\/fxjSH207632O\/m88\/BJFVx9aG4sPoE0M\/gdueh2TXHW",
                "phone": "08122019427",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "A62iLk",
                "created_at": "2023-05-29T16:33:01.000000Z",
                "updated_at": "2023-05-29T17:29:47.000000Z",
                "bank_account_name": "Aliman Mohammed",
                "bank": "033",
                "bank_account_number": "2225942297",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_h3jzip23iq2c8r2",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 133,
                "firstName": "IFUNANYA",
                "lastName": "GRACE",
                "email": "ifunanyagrace2019@gmail.com",
                "email_code": "4848",
                "email_verified": 1,
                "password": "$2y$10$ImSgejfOCU9cA1KFwIptNuo8lFLEqsiZCOvt7XBAjhvKiUw312ffW",
                "phone": "08086206863",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "1oXUlq",
                "created_at": "2023-05-29T17:24:32.000000Z",
                "updated_at": "2023-10-01T00:05:27.000000Z",
                "bank_account_name": "Uche ifunanya Grace",
                "bank": "057",
                "bank_account_number": "2080215662",
                "is_payed": "true",
                "total_aff_sales_cash": "95000",
                "total_aff_sales": "19",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_bdgz5npexi8o8po",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-09-24 22:11:34",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 134,
                "firstName": "Rosemary",
                "lastName": "Chikaodiri",
                "email": "irongatea@gmail.com",
                "email_code": "5291",
                "email_verified": 1,
                "password": "$2y$10$VUvTJ16gnBOURzLvyade.OODMW9VMfrFHOeR5PUr4Z9\/XSL61t1OC",
                "phone": "09024640975",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "WDGY30",
                "created_at": "2023-05-29T18:17:54.000000Z",
                "updated_at": "2023-05-29T21:57:34.000000Z",
                "bank_account_name": "Ikechebelu chikaodiri Rosemary",
                "bank": "070",
                "bank_account_number": "6320356291",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_77565v9xqyf3bqk",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 135,
                "firstName": "Francisca",
                "lastName": "Ilo",
                "email": "franciscachinaza83@gmail.com",
                "email_code": "7785",
                "email_verified": 1,
                "password": "$2y$10$ZnQK93crnF288GxnkN6Oy.Rsqu8rbjnySZvtdO96UmtFuP10DnV1y",
                "phone": "08103316892",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "sAdIPZ",
                "created_at": "2023-05-29T18:40:29.000000Z",
                "updated_at": "2023-08-13T00:24:00.000000Z",
                "bank_account_name": "Ilo Francisca Chinaza",
                "bank": "011",
                "bank_account_number": "3075524837",
                "is_payed": "true",
                "total_aff_sales_cash": "60000",
                "total_aff_sales": "10",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_nk2zauid7y91om5",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-08-04 11:57:50",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 136,
                "firstName": "Orutu",
                "lastName": "Petra",
                "email": "orutupetra606@gmail.com",
                "email_code": "5427",
                "email_verified": 1,
                "password": "$2y$10$Kidbrqrs3EQ8XRBmnQYOC.so7MUNw1Y8bt80hVHvPDnPANrWwyYZO",
                "phone": "09030604245",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "UnPIYw",
                "created_at": "2023-05-29T19:43:15.000000Z",
                "updated_at": "2023-05-29T20:16:50.000000Z",
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
                "id": 137,
                "firstName": "Adolor",
                "lastName": "Patricia",
                "email": "adolorpatricia30@gmail.com",
                "email_code": "9331",
                "email_verified": 1,
                "password": "$2y$10$mUBtYu1qEUBxBLHunv2BROjgHtKGuvecEXHAdRotJXNw86F8P6Ofm",
                "phone": "08068909707",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "u9HEw0",
                "created_at": "2023-05-29T20:04:48.000000Z",
                "updated_at": "2023-07-27T18:34:56.000000Z",
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
                "id": 138,
                "firstName": "Adejumo",
                "lastName": "Adeyinka",
                "email": "adeyinkaadejumo916@gmail.com",
                "email_code": "4820",
                "email_verified": 1,
                "password": "$2y$10$0zP\/axp9LETul6KwaH5TB.zKm8uZ6UJvAtcdHbbI\/dFSUKIzeWvUy",
                "phone": "09043259046",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "opKeTD",
                "created_at": "2023-05-29T20:12:28.000000Z",
                "updated_at": "2023-05-30T08:20:39.000000Z",
                "bank_account_name": "Access bank",
                "bank": "044",
                "bank_account_number": "1374427637",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_v83598fl4ycj807",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 139,
                "firstName": "Etinyene",
                "lastName": "Ime",
                "email": "etinyeneukpong409@gmail.com",
                "email_code": "5071",
                "email_verified": 1,
                "password": "$2y$10$YUJYtfoXfacmV9hLVLtUL.TONPBC6v2zi9FVKvVLzlcrLRm41G84.",
                "phone": "07064042275",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "eW5vJ9",
                "created_at": "2023-05-29T20:27:49.000000Z",
                "updated_at": "2023-05-30T00:07:53.000000Z",
                "bank_account_name": "Ukpong Etinyene Ime",
                "bank": "033",
                "bank_account_number": "2048604310",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_kukdviyqjsjoc1c",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 140,
                "firstName": "Nwankwo",
                "lastName": "Perpetual",
                "email": "perpetualchinemerem111@gmail.com",
                "email_code": "1679",
                "email_verified": 1,
                "password": "$2y$10$kX0GC98e7cSok\/sJFlAFDu9tXC.XZL84WtHQgED7GXvaaN.G9WxQ2",
                "phone": "07068669366",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "cy7lMW",
                "created_at": "2023-05-29T20:36:16.000000Z",
                "updated_at": "2023-07-26T11:27:57.000000Z",
                "bank_account_name": "Nwankwo chinemerem perpetual",
                "bank": "032",
                "bank_account_number": "0181510410",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_9r577sau40l8kjs",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 141,
                "firstName": "Esther",
                "lastName": "Chikamnayo",
                "email": "estherchikamnayo@gmail.com",
                "email_code": "7448",
                "email_verified": 1,
                "password": "$2y$10$bolohJM46OJEef2NMEMzEusug4\/P8EJzNP2wq.chryghvQnu97FK2",
                "phone": "08135205204",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "HcGutw",
                "created_at": "2023-05-29T20:42:58.000000Z",
                "updated_at": "2023-06-04T11:49:36.000000Z",
                "bank_account_name": "Okoro Chikamnayo Esther",
                "bank": "058",
                "bank_account_number": "0223288206",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_g9yaplgwjt0c9s0",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 142,
                "firstName": "Wahab",
                "lastName": "Halimat",
                "email": "alimatbolanle@gmail.com",
                "email_code": "3987",
                "email_verified": 1,
                "password": "$2y$10$avL7lP4aGsKSTc77xdP\/p.mpbxY.eDsyzTiHhPwC6pTvTlVCrjClq",
                "phone": "07062373802",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "0MIrPK",
                "created_at": "2023-05-29T21:23:09.000000Z",
                "updated_at": "2023-05-29T21:49:10.000000Z",
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
                "id": 143,
                "firstName": "Onwa",
                "lastName": "Francis",
                "email": "ifechukwufrance92@gmail.com",
                "email_code": "4962",
                "email_verified": 1,
                "password": "$2y$10$dihfKc\/u193gmYHt4at3xO9UWeliTK2d.Mr71sm5nata\/Ia57Fce.",
                "phone": "09026781395",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "2gacIS",
                "created_at": "2023-05-29T21:29:08.000000Z",
                "updated_at": "2023-05-29T21:56:25.000000Z",
                "bank_account_name": "Onwa Ifechukwu Francis",
                "bank": "50211",
                "bank_account_number": "2049271676",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_3l2hvabzz7121b9",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 144,
                "firstName": "Ngozi",
                "lastName": "Blessing",
                "email": "ngoziblessing76856@gmail.com",
                "email_code": "2147",
                "email_verified": 1,
                "password": "$2y$10$dbywCbXebbZAF0ert3QKv.CmP9S8coEwpb5\/udkOfeaQfW4S5aafa",
                "phone": "09116279471",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "wvB69o",
                "created_at": "2023-05-29T22:03:35.000000Z",
                "updated_at": "2023-05-31T13:55:44.000000Z",
                "bank_account_name": "Oliver ngozi blessing",
                "bank": "058",
                "bank_account_number": "0797471992",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_98hdfvimckjn9rn",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 145,
                "firstName": "Ahamefula",
                "lastName": "Anya",
                "email": "chybecky3@gmail.com",
                "email_code": "4345",
                "email_verified": 1,
                "password": "$2y$10$LTdWeX23nyCVenO9nVJXkugCfxFqFm5ym\/E2jq99vy384qMRnHvYe",
                "phone": "08161305506",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "X59LOl",
                "created_at": "2023-05-29T22:15:43.000000Z",
                "updated_at": "2023-05-29T22:53:02.000000Z",
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
                "id": 146,
                "firstName": "Ilonwa",
                "lastName": "Genevive",
                "email": "ilonwagenevive@gmail.con",
                "email_code": "6857",
                "email_verified": 1,
                "password": "$2y$10$VN8O13pg.PQiu\/5vwq5.oO6Kftc7VUldqhT9FoaP9BaxDCINW7XxG",
                "phone": "08166741831",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Uetpk5",
                "created_at": "2023-05-29T22:21:36.000000Z",
                "updated_at": "2023-06-19T15:14:09.000000Z",
                "bank_account_name": "Ilonwa Genevive Ifeoma",
                "bank": "044",
                "bank_account_number": "1537825854",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_05u1mu3fo8g9ki3",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 147,
                "firstName": "Omale",
                "lastName": "Stella",
                "email": "stellaomale11@gmail.com",
                "email_code": "3790",
                "email_verified": 1,
                "password": "$2y$10$R.lre43UVjQRj1AEGPVll.pvHYgpQEgryEMfwCYghWs0BMkQ5a8Xq",
                "phone": "09065048849",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "NzGXYL",
                "created_at": "2023-05-29T22:30:28.000000Z",
                "updated_at": "2023-05-30T20:04:56.000000Z",
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
                "id": 148,
                "firstName": "Togunde",
                "lastName": "Kafilat",
                "email": "kaphy.tk10@gmail.com",
                "email_code": "1664",
                "email_verified": 1,
                "password": "$2y$10$uA37YQHTzXBR\/MUT1OcM5OorJ8OD9xA35K86hDuigOAXk9IlrX\/na",
                "phone": "08135847846",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "z4E2xU",
                "created_at": "2023-05-29T22:32:50.000000Z",
                "updated_at": "2023-11-07T21:45:05.000000Z",
                "bank_account_name": "Togunde Kafilat",
                "bank": "035",
                "bank_account_number": "0254875331",
                "is_payed": "true",
                "total_aff_sales_cash": "390000",
                "total_aff_sales": "78",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "35000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_qnl730dlicjbusv",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-07 21:45:05",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 149,
                "firstName": "Juliet",
                "lastName": "Anyalechi",
                "email": "julietegbochue36@gmail.com",
                "email_code": "4074",
                "email_verified": 1,
                "password": "$2y$10$e82s30QzsWfAFQEPC15NoeOwnHCn6D12jo2eGcp5Z1xL2\/0v9gbw.",
                "phone": "07065065978",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "0oPJB7",
                "created_at": "2023-05-29T22:38:33.000000Z",
                "updated_at": "2023-06-03T07:56:11.000000Z",
                "bank_account_name": "Anyalechi Juliet ebere",
                "bank": "232",
                "bank_account_number": "0091698303",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_26oou0cf5lfbpw6",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 150,
                "firstName": "Irene onyinyechi",
                "lastName": "Nwagba",
                "email": "ireneonyinyechi007@gmail.com",
                "email_code": "9156",
                "email_verified": 1,
                "password": "$2y$10$Xc3e9ZkvgemQf1RS61VKTu9jHuaOmkoBeaRXWfM\/M6sb2GCZXZ8wW",
                "phone": "08160723390",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "fmIXMc",
                "created_at": "2023-05-29T23:59:44.000000Z",
                "updated_at": "2023-07-16T04:02:43.000000Z",
                "bank_account_name": "Nwagba Irene onyinyechi",
                "bank": "070",
                "bank_account_number": "6170018699",
                "is_payed": "true",
                "total_aff_sales_cash": "25000",
                "total_aff_sales": "5",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_10xt5e9bz9fv7ie",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 151,
                "firstName": "Hakeem",
                "lastName": "Araba",
                "email": "hakeemaraba2020@gmail.com",
                "email_code": "4185",
                "email_verified": 1,
                "password": "$2y$10$bFaAXTW4\/jPxNjLmc0YZ5e9GF\/LMbvqkweRRU0px5\/Y6Voi5VwgP2",
                "phone": "07063191260",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "If0iXd",
                "created_at": "2023-05-30T05:56:05.000000Z",
                "updated_at": "2023-05-30T06:45:07.000000Z",
                "bank_account_name": "WEMA BANK",
                "bank": "035A",
                "bank_account_number": "0233441267",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_mcddjeq3juaguij",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 152,
                "firstName": "Ginikachukwu",
                "lastName": "Ukwueze",
                "email": "jglory790@gmail.com",
                "email_code": "7321",
                "email_verified": 1,
                "password": "$2y$10$7dwzII3ogH8E2EpnQxrgy.\/lCgOWiRxQQMClvAtYsc9c0zVwP.PDW",
                "phone": "09065961314",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "L3wvkN",
                "created_at": "2023-05-30T06:07:40.000000Z",
                "updated_at": "2023-07-09T06:50:39.000000Z",
                "bank_account_name": "Ukwueze Ginikachukwu Glory",
                "bank": "044",
                "bank_account_number": "1454123392",
                "is_payed": "true",
                "total_aff_sales_cash": "215000",
                "total_aff_sales": "43",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_x2lj8vu3m55cgya",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 153,
                "firstName": "Anumnu",
                "lastName": "Victor",
                "email": "vanumnu@gmail.com",
                "email_code": "2814",
                "email_verified": 1,
                "password": "$2y$10$\/wrr\/CEuBLF60yQUHpXLiO0ipGqJrfn2zXKyfLF8wlRbrS08ZPBNW",
                "phone": "08130936054",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "7jUIGz",
                "created_at": "2023-05-30T06:16:54.000000Z",
                "updated_at": "2023-05-31T09:55:41.000000Z",
                "bank_account_name": "Anumnu Victor Chekwubechukwu",
                "bank": "063",
                "bank_account_number": "0083165374",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_5qb3ag8mgw7bw7q",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 154,
                "firstName": "Josh",
                "lastName": "Bukason",
                "email": "chukwuebukatimothy32@gmail.com",
                "email_code": "9651",
                "email_verified": 1,
                "password": "$2y$10$bbIazhSNrY3lBgYj4FSPuuzrLRmPOnEnhDW.\/QlLTeOaoYdxWbTeG",
                "phone": "08060895420",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "jMzs24",
                "created_at": "2023-05-30T06:18:31.000000Z",
                "updated_at": "2023-05-30T12:00:01.000000Z",
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
                "id": 155,
                "firstName": "Nwachukwu",
                "lastName": "Oluchi",
                "email": "nwachukwuoluchi2323@gmail.com",
                "email_code": "4160",
                "email_verified": 0,
                "password": "$2y$10$m8U5GVPM\/sSfctWZpCLAnOmQx8ZFKVT.UvYS3VEH9ojlmdQEmSB0i",
                "phone": "08140215058",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "oSbLVD",
                "created_at": "2023-05-30T06:26:19.000000Z",
                "updated_at": "2023-06-30T09:33:01.000000Z",
                "bank_account_name": null,
                "bank": null,
                "bank_account_number": null,
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0",
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
                "id": 156,
                "firstName": "Kalu",
                "lastName": "Ijeoma",
                "email": "destinyijeoma61@gmail.com",
                "email_code": "5215",
                "email_verified": 1,
                "password": "$2y$10$RuB9mMKWeMTpzYNs5KPYPuDRFlPISX\/PCZORDXKoqAfX3D7hEtrpy",
                "phone": "07033050974",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "mtFs43",
                "created_at": "2023-05-30T06:30:23.000000Z",
                "updated_at": "2023-07-30T06:08:52.000000Z",
                "bank_account_name": "Kaluosonwa Ijeoma Ikeme",
                "bank": "032",
                "bank_account_number": "0041627528",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_k9plyb1u0uwq3v8",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-07-26 21:13:09",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 157,
                "firstName": "Dominica",
                "lastName": "Chiamaka",
                "email": "chiamaka2dominica@gmail.com",
                "email_code": "7765",
                "email_verified": 1,
                "password": "$2y$10$WrC3a.HfU0Ak1oiNAsRRKO3S6X\/2x9CPW.ddQVgPqOTCk3D.85eIu",
                "phone": "08069759211",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "PvK475",
                "created_at": "2023-05-30T06:31:07.000000Z",
                "updated_at": "2023-05-30T16:14:37.000000Z",
                "bank_account_name": "Dominica chiamaka odidika",
                "bank": "070",
                "bank_account_number": "6235449259",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_f4vpy59zahs4io5",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 158,
                "firstName": "Nzeh",
                "lastName": "Chinenye",
                "email": "chinenyepatrick34@gmail.com",
                "email_code": "6852",
                "email_verified": 1,
                "password": "$2y$10$ERyGkG1yLGvzaqLoN.vwlOSlfpgb8KbNbrqIFIMddDWbPGw27wK4u",
                "phone": "07062236874",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "H7SRfx",
                "created_at": "2023-05-30T06:39:57.000000Z",
                "updated_at": "2023-05-30T09:16:50.000000Z",
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
                "id": 159,
                "firstName": "Hezikiah",
                "lastName": "Joseph",
                "email": "johezikiah69@gmail.com",
                "email_code": "5145",
                "email_verified": 1,
                "password": "$2y$10$Xqa6UpIpLPaGQ25ZnWODBu.JrVns4VwsDK7L1ezoNpm8lUjmceZaK",
                "phone": "09137190085",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "gd8jGz",
                "created_at": "2023-05-30T06:42:20.000000Z",
                "updated_at": "2023-05-30T09:04:26.000000Z",
                "bank_account_name": "Hezikiah Joseph",
                "bank": "033",
                "bank_account_number": "2253520627",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ztv1moft1nsi5dq",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 160,
                "firstName": "Nzeh",
                "lastName": "Tonia",
                "email": "glossy4few1992@gmail.com",
                "email_code": "7465",
                "email_verified": 1,
                "password": "$2y$10$JsANjGtGDrp1Ivnn.JRVieX63liubFT.8RHF06cc23\/iEHzq9F6wq",
                "phone": "08162016016",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "TWZqtU",
                "created_at": "2023-05-30T06:52:42.000000Z",
                "updated_at": "2023-06-19T10:06:29.000000Z",
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
                "id": 161,
                "firstName": "Precious",
                "lastName": "Thompson-Numbere",
                "email": "numbereprecious@gmail.com",
                "email_code": "6978",
                "email_verified": 1,
                "password": "$2y$10$PJXKxlMmTAoEdsXYIkPXXOiW4Vqgybqwd0ZrRGUliKsclNjva3CTa",
                "phone": "09056768159",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "kr8yf7",
                "created_at": "2023-05-30T06:56:07.000000Z",
                "updated_at": "2023-05-30T21:12:23.000000Z",
                "bank_account_name": "Precious Thompson-Numbere",
                "bank": "070",
                "bank_account_number": "6150084627",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_dj0k6vzzur6l5i9",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 162,
                "firstName": "Okorie",
                "lastName": "Confidence",
                "email": "marathonmirage@gmail.com",
                "email_code": "6843",
                "email_verified": 0,
                "password": "$2y$10$62QU8l1Q4OAE9QpXxXW58.o2SR4Cr6Aoaj9bEZ11jw0PpMIkBjVjy",
                "phone": "07055077939",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "NrkTuI",
                "created_at": "2023-05-30T07:03:15.000000Z",
                "updated_at": "2023-05-30T07:03:15.000000Z",
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
                "id": 163,
                "firstName": "OdinakaChukwu Daniel",
                "lastName": "Anosike",
                "email": "odinakachukwudaniel@gmail.com",
                "email_code": "8306",
                "email_verified": 1,
                "password": "$2y$10$HSFBisYgv1JiKt5OGyyKX.wdcPgJ8JvBMz7Gzl9wXmJTpvYPIGBVq",
                "phone": "08167579484",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "XC9mv2",
                "created_at": "2023-05-30T07:04:58.000000Z",
                "updated_at": "2023-06-07T01:10:23.000000Z",
                "bank_account_name": "Anosike Odinaka Daniel",
                "bank": "063",
                "bank_account_number": "0039273504",
                "is_payed": "true",
                "total_aff_sales_cash": "15000",
                "total_aff_sales": "3",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_2v98pdttxjjc79m",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 164,
                "firstName": "Ebisike",
                "lastName": "Joel",
                "email": "joelebisike@gmail.com",
                "email_code": "8839",
                "email_verified": 1,
                "password": "$2y$10$XUQCQ3QCgjJvLF0Ub6FiX.eaKTOYKmSbUrs98pOerJ2rLA8QSiFXK",
                "phone": "07013965167",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "lGfcSa",
                "created_at": "2023-05-30T07:09:31.000000Z",
                "updated_at": "2023-05-30T18:30:46.000000Z",
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
                "id": 165,
                "firstName": "Omeje",
                "lastName": "Chetachi",
                "email": "chetachiemmanuel5@gmail.com",
                "email_code": "4110",
                "email_verified": 1,
                "password": "$2y$10$mLJ1bDbpK4J1vhLscJljR.\/i2bcQ1Y3IkKtWxqldbBlq7541nI54i",
                "phone": "07049774378",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "HQ17zM",
                "created_at": "2023-05-30T07:22:14.000000Z",
                "updated_at": "2023-05-30T09:27:19.000000Z",
                "bank_account_name": "OMEJE EMMANUEL CHETACHI",
                "bank": "044",
                "bank_account_number": "0783236124",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_d1285ab3xv2g524",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 166,
                "firstName": "Abugu",
                "lastName": "Emmanuel",
                "email": "abuguemmanuel92@gmail.com",
                "email_code": "8511",
                "email_verified": 1,
                "password": "$2y$10$7ka22OyNIxHeW68ztYM6..j2oOzgwrR4eRf.r56d1ywlFkfhxunvm",
                "phone": "07031225586",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "H3uksw",
                "created_at": "2023-05-30T07:30:14.000000Z",
                "updated_at": "2023-05-31T07:52:01.000000Z",
                "bank_account_name": "ABUGU EMMANUEL",
                "bank": "032",
                "bank_account_number": "0185008962",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_sbxjtidtx58whkx",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 167,
                "firstName": "Happiness Ngozi",
                "lastName": "Okoro",
                "email": "ngozihappiness55@gmail.com",
                "email_code": "8035",
                "email_verified": 1,
                "password": "$2y$10$C8b9orcJa\/zEutphZqazYOSaKsZ0ULd3DHS0nhx3S5sMLKMKIWdF2",
                "phone": "08130414107",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "RF10OI",
                "created_at": "2023-05-30T07:30:44.000000Z",
                "updated_at": "2023-05-30T09:42:06.000000Z",
                "bank_account_name": "Okoro Happiness Ngozi",
                "bank": "044",
                "bank_account_number": "0008242475",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_r0g2qe0pt3ogcnn",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 168,
                "firstName": "Nwajiobi",
                "lastName": "Ifeoma",
                "email": "ifeomamartha3@gmail.com",
                "email_code": "4480",
                "email_verified": 1,
                "password": "$2y$10$C2PD1jKi0456hNz9Fefwy.uzf1iIKrfndjzfiAjoE\/zJXcu4HYG3O",
                "phone": "08065737471",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "axyHXq",
                "created_at": "2023-05-30T07:37:48.000000Z",
                "updated_at": "2023-05-30T13:29:56.000000Z",
                "bank_account_name": "Nwajiobi Ifeoma Martha",
                "bank": "044",
                "bank_account_number": "0029449567",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_5sucyn7a1mmdniz",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 169,
                "firstName": "Tasie",
                "lastName": "Stephen",
                "email": "stephentasie45@gmail.com",
                "email_code": "9397",
                "email_verified": 1,
                "password": "$2y$10$9Zm4oEd0fiy5CE7TFIxuCeBbxWMG.Lss1bE9wFT2nTbTC6fctNJjW",
                "phone": "09137489494",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "MNyreU",
                "created_at": "2023-05-30T07:44:05.000000Z",
                "updated_at": "2023-05-30T08:49:44.000000Z",
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
                "id": 170,
                "firstName": "Charity",
                "lastName": "Okpanachi",
                "email": "okpanachiella@gmail.com",
                "email_code": "3454",
                "email_verified": 1,
                "password": "$2y$10$jB1jKr7lXCQaR8AfMaybxuKLAqLNsOdAyXCS1bzbzR\/49M05ExGki",
                "phone": "08119884733",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Z7GYhK",
                "created_at": "2023-05-30T07:48:33.000000Z",
                "updated_at": "2023-06-01T15:18:54.000000Z",
                "bank_account_name": "Charity okpanachi ojoma",
                "bank": "033",
                "bank_account_number": "2013536000",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_3fw18zrmwfmana3",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 171,
                "firstName": "Haruna",
                "lastName": "Ibrahim",
                "email": "ibharuna57@gmail.com",
                "email_code": "1092",
                "email_verified": 0,
                "password": "$2y$10$\/ZP.V4p.EGEQK9bPo.mZX.7mGpMD8QWbCscHxl9P3cwO59kfu.eja",
                "phone": "07015172429",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "mu2VwG",
                "created_at": "2023-05-30T07:51:31.000000Z",
                "updated_at": "2023-05-30T07:51:31.000000Z",
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
                "id": 172,
                "firstName": "Nwakuba Maryjane",
                "lastName": "Chinemelum",
                "email": "cheaterigwe@gmail.com",
                "email_code": "9635",
                "email_verified": 1,
                "password": "$2y$10$x.ht9ukCU20KeGk.7aKtf.w6UCU\/iUQoHRqcByZ4e0242.4QmfdvC",
                "phone": "07083149875",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "P7mEnG",
                "created_at": "2023-05-30T07:52:00.000000Z",
                "updated_at": "2023-05-30T11:30:44.000000Z",
                "bank_account_name": "Nwakuba Maryjane Chinemelum",
                "bank": "033",
                "bank_account_number": "2183066668",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ynnm4bjhd0veydp",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 173,
                "firstName": "Ishmael",
                "lastName": "Atama",
                "email": "atamaishmael1st@gmail.com",
                "email_code": "3181",
                "email_verified": 1,
                "password": "$2y$10$E3nEM9mHx4H7P7.QpfUf\/ODJjhaAcFt0Un5B7j6WCj645cVrT5Ao.",
                "phone": "08124265499",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "mIBaP8",
                "created_at": "2023-05-30T08:04:05.000000Z",
                "updated_at": "2023-05-30T10:21:26.000000Z",
                "bank_account_name": "Atama Ishmael",
                "bank": "044",
                "bank_account_number": "1398695537",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_nsn52fsvnyv21ee",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 174,
                "firstName": "Marvelous",
                "lastName": "Ogbonna",
                "email": "martinsmarvelous6@gmail.com",
                "email_code": "2309",
                "email_verified": 1,
                "password": "$2y$10$lRqhWfIxctF0J\/yJjGz18OL9\/\/sRnPgNLJTmk6Nsz33I9Uk7YY3Zy",
                "phone": "09161184515",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "pFhAkV",
                "created_at": "2023-05-30T08:15:05.000000Z",
                "updated_at": "2023-11-05T00:41:30.000000Z",
                "bank_account_name": "Ogbonna marvelous chinwenmeri",
                "bank": "058",
                "bank_account_number": "0691114117",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_w13pvz31ve80zd1",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-03 14:10:46",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 175,
                "firstName": "Francis",
                "lastName": "Adeniyi",
                "email": "temmyplato@gmail.com",
                "email_code": "2661",
                "email_verified": 1,
                "password": "$2y$10$cyMYUllVatYHdBFt1cewYuxuZhnf9aWGbyHj89xEQmt\/GaJRe7fOe",
                "phone": "08103498607",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "QdGyHx",
                "created_at": "2023-05-30T08:20:12.000000Z",
                "updated_at": "2023-06-18T00:41:48.000000Z",
                "bank_account_name": "Adeniyi Francis Temidayo",
                "bank": "033",
                "bank_account_number": "2146187366",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_a7p1g1wj7nzc9n0",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 176,
                "firstName": "Moruff",
                "lastName": "Kazeem",
                "email": "moruffkazeem8@gmail.com",
                "email_code": "2376",
                "email_verified": 1,
                "password": "$2y$10$mL5yOE83hrLlFz2ChJt.\/eHIfDe6xAiqUGEbMrbIdkbKIjBphK00.",
                "phone": "08065261668",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "soZGFR",
                "created_at": "2023-05-30T08:20:55.000000Z",
                "updated_at": "2023-05-30T09:25:32.000000Z",
                "bank_account_name": "Moruff kazeem",
                "bank": "044",
                "bank_account_number": "0054062950",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_6o4rjaf10ngmgve",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 177,
                "firstName": "Rachael",
                "lastName": "Edet Bassey",
                "email": "raychelleb01@gmail.com",
                "email_code": "8494",
                "email_verified": 1,
                "password": "$2y$10$33y3QYLPqWWTAxhsnQd7tOzlJUJwFZOMh0WKbQIixDpHkveQIrdlW",
                "phone": "07056062866",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "3FURW0",
                "created_at": "2023-05-30T08:28:29.000000Z",
                "updated_at": "2023-09-10T05:57:36.000000Z",
                "bank_account_name": "Rachael Edet Bassey",
                "bank": "057",
                "bank_account_number": "2009281811",
                "is_payed": "true",
                "total_aff_sales_cash": "30000",
                "total_aff_sales": "6",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_vxvb1z6tu00wttq",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-08-16 11:55:32",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 178,
                "firstName": "Anozie",
                "lastName": "Valentina Chinemelum",
                "email": "anozievalentina@gmail.com",
                "email_code": "7321",
                "email_verified": 1,
                "password": "$2y$10$ZROSai2r1q5\/UlOg.gM5leQYw1KDIfR4kQU4CKPVwnzqOuTE72NfC",
                "phone": "08142222952",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "uqH83g",
                "created_at": "2023-05-30T08:30:39.000000Z",
                "updated_at": "2023-07-31T23:26:40.000000Z",
                "bank_account_name": "Anozie chinemelum Valentina",
                "bank": "011",
                "bank_account_number": "3128059143",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_rcpq1tbv17ee00j",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 179,
                "firstName": "Justina",
                "lastName": "Okeke",
                "email": "amakaosita81@gmail.com",
                "email_code": "6408",
                "email_verified": 1,
                "password": "$2y$10$dqP3gX9SKybpEIsdR0c\/Qe2rymxBKOVhm.SqJbeUmfMhIDvy6n9rC",
                "phone": "08134455466",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "GiOs4U",
                "created_at": "2023-05-30T08:51:46.000000Z",
                "updated_at": "2023-05-30T12:44:57.000000Z",
                "bank_account_name": "Okeke Justina",
                "bank": "011",
                "bank_account_number": "3116198153",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_l4r3b4zz53c49rc",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 180,
                "firstName": "Chinaka",
                "lastName": "Kingsley Chinonso",
                "email": "chinakakingsley4god@gmail.com",
                "email_code": "7471",
                "email_verified": 1,
                "password": "$2y$10$6SoznJFZQMlq3bHABwOpOOY6vg774GZPq\/6XA7SuMhTz2bUW..4G.",
                "phone": "08101755505",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "hEKFB6",
                "created_at": "2023-05-30T08:59:12.000000Z",
                "updated_at": "2023-06-07T01:10:26.000000Z",
                "bank_account_name": "Chinaka Kingsley Chinonso",
                "bank": "033",
                "bank_account_number": "2145395739",
                "is_payed": "true",
                "total_aff_sales_cash": "15000",
                "total_aff_sales": "3",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_porevlbs476zppd",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 181,
                "firstName": "Abraham",
                "lastName": "Tarenebowei",
                "email": "tarinebowei@gmail.com",
                "email_code": "8827",
                "email_verified": 1,
                "password": "$2y$10$b9ulKGB2nU5s2X22PNa1j.62nLqML\/XZUSev7\/rl7o0LFCJ9lVBXy",
                "phone": "09023621095",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "pgtn3b",
                "created_at": "2023-05-30T09:25:54.000000Z",
                "updated_at": "2023-05-30T09:34:53.000000Z",
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
                "id": 182,
                "firstName": "Okpani",
                "lastName": "Ngozi vivian",
                "email": "okeaningozi@gmail.com",
                "email_code": "3524",
                "email_verified": 1,
                "password": "$2y$10$PTJOCHcIuhioCS0aZBrzsutllVepOZnjjco6Upb7KG2SqpMo8I9Nq",
                "phone": "07082095427",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "3NeVDG",
                "created_at": "2023-05-30T09:26:52.000000Z",
                "updated_at": "2023-06-02T14:58:29.000000Z",
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
                "id": 183,
                "firstName": "Okirhom",
                "lastName": "Ken",
                "email": "izebhijeken@gmail.com",
                "email_code": "5019",
                "email_verified": 1,
                "password": "$2y$10$f92Rr\/llo5hbEu8auodk\/eXtnwtNGu\/368B9PK4NYU6v4F6yMRvMS",
                "phone": "09056517551",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "hRBr5V",
                "created_at": "2023-05-30T09:42:55.000000Z",
                "updated_at": "2023-05-30T12:33:36.000000Z",
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
                "id": 184,
                "firstName": "Irene",
                "lastName": "Gabriel Nkechi",
                "email": "irenegabby20@gmail.com",
                "email_code": "7000",
                "email_verified": 1,
                "password": "$2y$10$WCrfZ6.jfZ0nNOLjdNtGd.LtkVU8YMXn92ZrcLvaZyPArjDeSzdlS",
                "phone": "08112989772",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "UuxEIs",
                "created_at": "2023-05-30T09:44:39.000000Z",
                "updated_at": "2023-05-30T11:35:28.000000Z",
                "bank_account_name": "Gabriel Nkechi Irene",
                "bank": "011",
                "bank_account_number": "3132075429",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_dj40r3dn77p6sjf",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 185,
                "firstName": "Theresa",
                "lastName": "Delight",
                "email": "delighttessy01@gmail.com",
                "email_code": "8607",
                "email_verified": 1,
                "password": "$2y$10$NaTxodVLFlLcMyYz6E.9UOcNy2l5ImNl8\/SHoQFynpw9Kh.TxE\/Ta",
                "phone": "07033408596",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "472SFw",
                "created_at": "2023-05-30T09:47:21.000000Z",
                "updated_at": "2023-06-19T11:43:57.000000Z",
                "bank_account_name": "Theresa ene James",
                "bank": "076",
                "bank_account_number": "3014234774",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_r3s7xeoht4d7d9d",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 186,
                "firstName": "Falodun",
                "lastName": "Boluwatife",
                "email": "boluwatifedamilare777@gmail.com",
                "email_code": "3779",
                "email_verified": 1,
                "password": "$2y$10$1zmOEL4bYy7U7EygZ.jTbeU7ufrHhsisaq5zNzuw6UiTN5evW.HaS",
                "phone": "09161863256",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "PTwJeR",
                "created_at": "2023-05-30T09:47:38.000000Z",
                "updated_at": "2023-05-31T06:04:20.000000Z",
                "bank_account_name": "Palmpay",
                "bank": "999991",
                "bank_account_number": "9161863256",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_morn7nxrvb4127a",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 187,
                "firstName": "Edim",
                "lastName": "Janet",
                "email": "edimjanet1998@gmail.com",
                "email_code": "7275",
                "email_verified": 1,
                "password": "$2y$10$9SCDULkJuNuK.JTkf3yPxODIP4QQ.CYaECkAOJ4kK0DcM0b2vDRv.",
                "phone": "07019343532",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ajn1Rz",
                "created_at": "2023-05-30T10:03:31.000000Z",
                "updated_at": "2023-05-30T20:26:34.000000Z",
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
                "id": 188,
                "firstName": "Israel",
                "lastName": "Ezeamuzie",
                "email": "ezeamuzieisraelite@gmail.com",
                "email_code": "5224",
                "email_verified": 1,
                "password": "$2y$10$6wgKaKhlf7kegH4NJorhCuAYEc9gdiNtdd\/tsHqkJ4QRsMXkx8oDG",
                "phone": "08174122365",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "XK9Wv1",
                "created_at": "2023-05-30T10:11:13.000000Z",
                "updated_at": "2023-06-18T06:28:48.000000Z",
                "bank_account_name": "Ezeamuzie Israel Chiazokam",
                "bank": "033",
                "bank_account_number": "2132228967",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_c0ehu1gj8049x2g",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 189,
                "firstName": "Margaret Tina",
                "lastName": "Johnson",
                "email": "margarettina25@gmail.com",
                "email_code": "8453",
                "email_verified": 1,
                "password": "$2y$10$NyW18O4vvVgfM77eWLSag.dJZELY\/2EditNcvMU9zvzIMB2QlxQlO",
                "phone": "08036492807",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "twZnDW",
                "created_at": "2023-05-30T10:45:36.000000Z",
                "updated_at": "2023-05-30T12:58:47.000000Z",
                "bank_account_name": "Johnson Margaret Tina",
                "bank": "033",
                "bank_account_number": "2231898379",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ookkaf6y16tv9ag",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 190,
                "firstName": "Chinedu",
                "lastName": "Solomon Ogbuagu",
                "email": "os5859981@gmail.com",
                "email_code": "5825",
                "email_verified": 1,
                "password": "$2y$10$OWYk0JYea3H2KSep\/.Nk5O5u5VRbYdPrR9yfE4duFpLvnSqOvqO5W",
                "phone": "09030412524",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "hcxKS6",
                "created_at": "2023-05-30T11:58:18.000000Z",
                "updated_at": "2023-05-30T17:16:16.000000Z",
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
                "id": 191,
                "firstName": "Queeneth",
                "lastName": "Opurum",
                "email": "queenethopurum20@gmail.com",
                "email_code": "8521",
                "email_verified": 1,
                "password": "$2y$10$nG.Sy\/SFXqM3G3TCZ3Gzc.67WQe.m1YGWcYYVvLZKRcwDdgy3GGne",
                "phone": "08032231438",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Wp3FTE",
                "created_at": "2023-05-30T12:03:14.000000Z",
                "updated_at": "2023-10-07T20:48:36.000000Z",
                "bank_account_name": "Opurum Queeneth Chinonyerem",
                "bank": "50515",
                "bank_account_number": "5372151010",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "10000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_zrw85m0ttp6jstl",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-06 15:06:19",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 192,
                "firstName": "Opeyemi",
                "lastName": "Kaosara",
                "email": "kaosaraopeyemi19@gmail.com",
                "email_code": "8482",
                "email_verified": 1,
                "password": "$2y$10$KLlNujKUpMxFtAtoDeoqQuCsi4lDUd4FpFT6WF3jwBFPZwK\/2Czta",
                "phone": "07069225648",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "a0KgA3",
                "created_at": "2023-05-30T12:14:55.000000Z",
                "updated_at": "2023-05-31T09:13:31.000000Z",
                "bank_account_name": "Sulaiman Kaosara Opeyemi",
                "bank": "044",
                "bank_account_number": "1494256209",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_zsl9p4qr5cvgve0",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 193,
                "firstName": "Angela",
                "lastName": "Onoko",
                "email": "confidenceakpana@gmail.com",
                "email_code": "7845",
                "email_verified": 1,
                "password": "$2y$10$hto3VEOvu6y2lBGyAG7GwuQkkUkPotvraRrtYsb1qW6xSUptRdDyO",
                "phone": "08163313657",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "jDX8uv",
                "created_at": "2023-05-30T12:31:15.000000Z",
                "updated_at": "2023-11-05T00:41:30.000000Z",
                "bank_account_name": "Onoko Angela",
                "bank": "057",
                "bank_account_number": "2123196303",
                "is_payed": "true",
                "total_aff_sales_cash": "65000",
                "total_aff_sales": "13",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_3mnkxrw2iges6b6",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-29 10:23:55",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 194,
                "firstName": "Joel",
                "lastName": "Oyekunle",
                "email": "oyekunlejoel30@gmail.com",
                "email_code": "1096",
                "email_verified": 1,
                "password": "$2y$10$0ypS95MRpeBJHdtqqKjUyOQFawTlg\/DuHZ5oA5srS.Zs1TfukGG.e",
                "phone": "08085197069",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "FyALcR",
                "created_at": "2023-05-30T12:52:56.000000Z",
                "updated_at": "2023-05-31T12:13:55.000000Z",
                "bank_account_name": "Joel oluwashina oyekunle",
                "bank": "033",
                "bank_account_number": "2265425242",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_mln7goyiqpfibf4",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 195,
                "firstName": "Benedict",
                "lastName": "Okonkwo",
                "email": "okonkwobenmary@gmail.com",
                "email_code": "2362",
                "email_verified": 1,
                "password": "$2y$10$JsOhixnI4PdOwuzDrYpEJO8U9VfqKv\/qlHAUp6iy8bsbhElktpANi",
                "phone": "07061635332",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "iPj285",
                "created_at": "2023-05-30T13:08:11.000000Z",
                "updated_at": "2023-05-30T13:55:53.000000Z",
                "bank_account_name": "Benedict Okonkwo",
                "bank": "057",
                "bank_account_number": "2380354830",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ajwzvyvifv7odgd",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 196,
                "firstName": "Chukwudumebi",
                "lastName": "Nwachukwu",
                "email": "nwachukwuchukwudumebi@gmail.com",
                "email_code": "4908",
                "email_verified": 1,
                "password": "$2y$10$Lf6VNytfpWHM5nIdE6FZ2.jpS5jLbSEl9SLDMN01ESpUqmRxsjS\/K",
                "phone": "08163446943",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "4ZMaJt",
                "created_at": "2023-05-30T13:09:14.000000Z",
                "updated_at": "2023-10-01T00:05:29.000000Z",
                "bank_account_name": "Nwachukwu Chukwudumebi",
                "bank": "033",
                "bank_account_number": "2295446505",
                "is_payed": "true",
                "total_aff_sales_cash": "50000",
                "total_aff_sales": "8",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_fn0uthomdzpqdcu",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "15000",
                "last_sale_time": "2023-09-27 09:38:16",
                "last_sale_product": "6",
                "currency": "NGN"
            }, {
                "id": 197,
                "firstName": "Chiamaka",
                "lastName": "Nwali",
                "email": "chiamakal902@gmail.com",
                "email_code": "3531",
                "email_verified": 1,
                "password": "$2y$10$eC2DQ8\/uzhOD.5W8XKyOWOrW\/B15d219pR2SnmnO8nBEzb4NaSNvW",
                "phone": "07084633910",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "SYlxB4",
                "created_at": "2023-05-30T13:18:35.000000Z",
                "updated_at": "2023-05-30T13:35:01.000000Z",
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
                "id": 198,
                "firstName": "Nyetoro Nsisong",
                "lastName": "Abraham",
                "email": "praisepearl23@gmail.com",
                "email_code": "9496",
                "email_verified": 1,
                "password": "$2y$10$cKAdxBdg.R4eAdwtlCg1ZODSFUeHakbwYeE1enhw\/0BsjLXu83hjO",
                "phone": "08135327334",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Tbv4zV",
                "created_at": "2023-05-30T15:02:45.000000Z",
                "updated_at": "2023-05-30T15:47:00.000000Z",
                "bank_account_name": "Nyetoro Nsisong Abraham",
                "bank": "011",
                "bank_account_number": "3176439128",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_pexhkqtybdrnpr7",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 199,
                "firstName": "Florence",
                "lastName": "Ayuba",
                "email": "ayubaf09@gmail.com",
                "email_code": "1566",
                "email_verified": 1,
                "password": "$2y$10$z.Lx0ZK5JhLOhBlVoLUr4ObWTK0w0m\/.7orl\/HPxGWrQlWTKue3nu",
                "phone": "08104107887",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "UPkluD",
                "created_at": "2023-05-30T15:20:14.000000Z",
                "updated_at": "2023-10-27T08:41:03.000000Z",
                "bank_account_name": "Ayuba Glory Florence",
                "bank": "058",
                "bank_account_number": "0663462787",
                "is_payed": "true",
                "total_aff_sales_cash": "15000",
                "total_aff_sales": "3",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "5000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_zu3s5zrmel6ejvj",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-27 08:41:03",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 200,
                "firstName": "OKPAHE",
                "lastName": "IDAGU",
                "email": "okpaheg@gmail.com",
                "email_code": "2181",
                "email_verified": 1,
                "password": "$2y$10$6BjsSgwZKp5pprUMDmBXSOpfpgzas327EQWvNYzJ3nsTaUF7LSNhy",
                "phone": "08133510087",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "6YMcZO",
                "created_at": "2023-05-30T15:51:55.000000Z",
                "updated_at": "2023-08-26T23:07:08.000000Z",
                "bank_account_name": "OKPAHE GODWIN IDAGU",
                "bank": "011",
                "bank_account_number": "3138408102",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_juhjyyqt3rr1pco",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 201,
                "firstName": "Victor",
                "lastName": "Chinecherem",
                "email": "vicktor5229@gmail.com",
                "email_code": "8667",
                "email_verified": 1,
                "password": "$2y$10$KS6O9FGOf8jolDtQv9l3peBuIVYStYwQ5WfH2yy549mK6s\/4tYG0e",
                "phone": "08089005229",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "dJhm4n",
                "created_at": "2023-05-30T16:51:59.000000Z",
                "updated_at": "2023-09-12T17:33:34.000000Z",
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
                "id": 202,
                "firstName": "Arinze",
                "lastName": "Timothy",
                "email": "forgodmanager@gmail.com",
                "email_code": "6402",
                "email_verified": 1,
                "password": "$2y$10$koHR9hk\/5d.ZnGknyXAyR.6XNU52KTC2dmd1OtPARTBj2TrH8BHUm",
                "phone": "09035149061",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "EJQYth",
                "created_at": "2023-05-30T17:11:33.000000Z",
                "updated_at": "2023-05-30T17:37:02.000000Z",
                "bank_account_name": "Arinze Timothy Ogbonna",
                "bank": "011",
                "bank_account_number": "3190694549",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_l3doapvlxtpn5cd",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 203,
                "firstName": "Ifechukwu Cynthia",
                "lastName": "Ikechukwu",
                "email": "cynthialuv2000@gmail.com",
                "email_code": "3364",
                "email_verified": 1,
                "password": "$2y$10$JcblcMYkdqzG6EkJQ8yS\/uXhdyaXssOWCLsNsUastoGNqqcrGKMXG",
                "phone": "0 815 362 1190",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "WEXi32",
                "created_at": "2023-05-30T19:17:05.000000Z",
                "updated_at": "2023-05-30T20:15:32.000000Z",
                "bank_account_name": "Ikechukwu Ifechukwu cynthia",
                "bank": "044",
                "bank_account_number": "1696369743",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_agx17kux8wqzrpu",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 204,
                "firstName": "Nguseter",
                "lastName": "Tanguhwar",
                "email": "teefaniez@gmail.com",
                "email_code": "1558",
                "email_verified": 1,
                "password": "$2y$10$jhsZiJ0vOz\/SOg9NcZSnXekT\/ij2OuE6Kfhz4ormnvyAfA5yw47M2",
                "phone": "09051108510",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "k4wJXB",
                "created_at": "2023-05-30T20:23:22.000000Z",
                "updated_at": "2023-06-05T17:56:33.000000Z",
                "bank_account_name": "Nguseter Stephanie Tanguhwar",
                "bank": "232",
                "bank_account_number": "0088111312",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_kwckt12a3majptd",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 205,
                "firstName": "Florence",
                "lastName": "Agha",
                "email": "acflorence60@gmail.com",
                "email_code": "9008",
                "email_verified": 1,
                "password": "$2y$10$f9HjpQIhadCJCnu6p.kzw.1snZOZ0p3J6LTdZ7EnYiD6CS1iuxx42",
                "phone": "07064990411",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ngeNbR",
                "created_at": "2023-05-30T20:28:35.000000Z",
                "updated_at": "2023-08-20T07:42:06.000000Z",
                "bank_account_name": "Agha Florence",
                "bank": "050",
                "bank_account_number": "5372035266",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_j5doc2dvnvbqnsp",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 206,
                "firstName": "Daniel",
                "lastName": "Karimu",
                "email": "danielkarim625@gmail.com",
                "email_code": "6679",
                "email_verified": 1,
                "password": "$2y$10$R46PC46koPu4T.ZdfXShq.Nk.9epcTt3sAx\/sI.eyWo7NpmuBLC9W",
                "phone": "09045134450",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "9FSrx8",
                "created_at": "2023-05-30T20:41:31.000000Z",
                "updated_at": "2023-07-02T01:56:24.000000Z",
                "bank_account_name": "Daniel Karimu Oyinkansade",
                "bank": "044",
                "bank_account_number": "1413125360",
                "is_payed": "true",
                "total_aff_sales_cash": "35000",
                "total_aff_sales": "7",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_gwj7m8v4mu6spcx",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 207,
                "firstName": "First Name",
                "lastName": "Last Name",
                "email": "foobar@example.com",
                "email_code": "4127",
                "email_verified": 0,
                "password": "$2y$10$39WSA8XttWJn.QmxZfbde.LT.q4JcIWesK\/odsG365rAEe83Y0DkW",
                "phone": "08158142681",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "XOEs2F",
                "created_at": "2023-05-30T20:45:11.000000Z",
                "updated_at": "2023-05-30T20:45:11.000000Z",
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
                "id": 208,
                "firstName": "Okpara",
                "lastName": "Chinecherem",
                "email": "okparacallista3@gmail.com",
                "email_code": "8518",
                "email_verified": 1,
                "password": "$2y$10$840rXA66zNTWSVhhExo1QeWYkD3zWLSB3gN7.TQPW7enN9JUE8K92",
                "phone": "07033179986",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "SyBYA6",
                "created_at": "2023-05-30T20:48:52.000000Z",
                "updated_at": "2023-06-09T06:20:31.000000Z",
                "bank_account_name": "Okpara chinecherem callista",
                "bank": "044",
                "bank_account_number": "1531359818",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_doaejrefa66bzol",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 209,
                "firstName": "Samuel",
                "lastName": "Amadi",
                "email": "chibuikesamuel545@gmail.com",
                "email_code": "1847",
                "email_verified": 1,
                "password": "$2y$10$2nKzSMzOYbutuZHcmLojVuezg8Y.7E8bibyhF.qNMz0lH5jSRd0T6",
                "phone": "09069338875",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "unSeMW",
                "created_at": "2023-05-30T20:51:08.000000Z",
                "updated_at": "2023-07-20T10:53:43.000000Z",
                "bank_account_name": "AMADI SAMUEL CHIBUIKE",
                "bank": "058",
                "bank_account_number": "0729909102",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ktqxmn2xba97vjy",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 210,
                "firstName": "Beatrice",
                "lastName": "Joseph",
                "email": "joebglow@gmail.com",
                "email_code": "1188",
                "email_verified": 1,
                "password": "$2y$10$mOH2nMa\/SeaW4SefS\/8Mc.D.DhzJa\/ohM42dfAOq5sQSKU5nLida2",
                "phone": "07068761714",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "wTFJyP",
                "created_at": "2023-05-30T21:01:50.000000Z",
                "updated_at": "2023-05-31T20:01:50.000000Z",
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
                "id": 211,
                "firstName": "Great",
                "lastName": "Leo",
                "email": "nnamdichukwuma51@gmail.com",
                "email_code": "7824",
                "email_verified": 1,
                "password": "$2y$10$GiRFDZ9pZv8C7Luw0aXODOTS\/DUcEiWMGyst1n7uaSiKQO4F5zbZC",
                "phone": "07047218436",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "6Wjr0X",
                "created_at": "2023-05-30T21:13:26.000000Z",
                "updated_at": "2023-06-01T07:54:58.000000Z",
                "bank_account_name": "Nnamdi chukwuma",
                "bank": "033",
                "bank_account_number": "2134218751",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_0pktnrsqyaj1es4",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 212,
                "firstName": "Christian",
                "lastName": "Chukwebuka",
                "email": "chukwebukachristian1@gmail.com",
                "email_code": "4338",
                "email_verified": 1,
                "password": "$2y$10$037L7\/0JftqWAp80K6Hwze2Q7w9ZPj8Dnn\/\/KRiVBQdKEW2oNq1TO",
                "phone": "08144473857",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "COhX9R",
                "created_at": "2023-05-30T21:40:47.000000Z",
                "updated_at": "2023-05-30T22:17:40.000000Z",
                "bank_account_name": "Achu chukwebuka Christian",
                "bank": "044",
                "bank_account_number": "1485606103",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_bq9gkhaqvdq465t",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 213,
                "firstName": "Boluwatife",
                "lastName": "Onawale",
                "email": "boluwatifeonawale@gmail.com",
                "email_code": "2604",
                "email_verified": 1,
                "password": "$2y$10$KfDGRbsOsfEbMGUMFwwIOuRJMDDpaQTFL4\/.YAxqLgswz8d.Gcgsq",
                "phone": "09018941151",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "mxbXFu",
                "created_at": "2023-05-30T21:53:46.000000Z",
                "updated_at": "2023-06-01T10:21:31.000000Z",
                "bank_account_name": "Onawale boluwatife dayo",
                "bank": "033",
                "bank_account_number": "2157116656",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_rbdrsdgmddrbs88",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 214,
                "firstName": "Elumeze",
                "lastName": "Prosper",
                "email": "elumezeprosper51@gmail.com",
                "email_code": "2861",
                "email_verified": 1,
                "password": "$2y$10$Q35n9Flxw2jxiIAuCNWLB.ZSmgZeCO9ssCIlI2CgosCt\/Qz9GsNVy",
                "phone": "08136694448",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "eW1dpv",
                "created_at": "2023-05-30T22:13:10.000000Z",
                "updated_at": "2023-05-31T09:11:53.000000Z",
                "bank_account_name": "Uchechukwu prosper Elumeze",
                "bank": "999991",
                "bank_account_number": "8136694448",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_nb5rxj06mpjcxz3",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 215,
                "firstName": "MICHAEL",
                "lastName": "ODUKOMAIYA",
                "email": "choosenabidemi@gmail.com",
                "email_code": "3622",
                "email_verified": 1,
                "password": "$2y$10$I22cWM0x0rL0x2WEPEZ7TusldzX5wlq5S.cFyqqIqo6iE0g\/zS.DG",
                "phone": "09035343800",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "iAy7EF",
                "created_at": "2023-05-30T23:38:15.000000Z",
                "updated_at": "2023-05-31T00:04:11.000000Z",
                "bank_account_name": "Odukomaiya Michael Abidemi",
                "bank": "011",
                "bank_account_number": "3144775933",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_0ndufg3xakgi23k",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 216,
                "firstName": "Fredrick",
                "lastName": "Kelly",
                "email": "alfredkelly44@gmail.com",
                "email_code": "2503",
                "email_verified": 1,
                "password": "$2y$10$SCx4HWrLITrCa2R1MiHrG.4hPA7qB6QKwFIcfqf3gI7wpNeosXeGa",
                "phone": "08107175742",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "3SVzC9",
                "created_at": "2023-05-31T06:40:48.000000Z",
                "updated_at": "2023-05-31T07:17:38.000000Z",
                "bank_account_name": "Fredrick Osaluobe Kelly",
                "bank": "044",
                "bank_account_number": "1435301881",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ex6a1ke393r5534",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 217,
                "firstName": "SAMUEL",
                "lastName": "AJAYI",
                "email": "prof.samgozman135@gmail.com",
                "email_code": "7620",
                "email_verified": 1,
                "password": "$2y$10$QgsvfJRzbBALFAhxHek1duRmt8Q2uJ4APGH79MCP5OUvU4g8rtUP.",
                "phone": "09060492824",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "WgazIx",
                "created_at": "2023-05-31T07:02:56.000000Z",
                "updated_at": "2023-07-02T01:56:26.000000Z",
                "bank_account_name": "Samuel Ajayi Oluwatobiloba",
                "bank": "057",
                "bank_account_number": "4203130474",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_lbt9rk1i7jqf76t",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 220,
                "firstName": "Akinmola",
                "lastName": "Rebecca",
                "email": "www.rebecious@gmail.com",
                "email_code": "1689",
                "email_verified": 1,
                "password": "$2y$10$P3vWapLDc5Q5na2wZZUsRuQE8bSoRfibE\/9iitLdBWx\/iBwCh30Aq",
                "phone": "09160805884",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "kKDnCj",
                "created_at": "2023-05-31T10:28:29.000000Z",
                "updated_at": "2023-06-02T15:48:28.000000Z",
                "bank_account_name": "Akinmola Rebecca Busayo",
                "bank": "063",
                "bank_account_number": "0046419984",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_xs7ef7g4abyn9x8",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 221,
                "firstName": "Sewa Ayomide",
                "lastName": "Adekunle",
                "email": "sewaadekunle65@gmail.com",
                "email_code": "1563",
                "email_verified": 1,
                "password": "$2y$10$JmSR0v.7p0Cnu33nrUlX8eOLzhk3Ka2olHFQb.bzimBJbqnK8tMlC",
                "phone": "08147892673",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "axnzJG",
                "created_at": "2023-05-31T11:24:35.000000Z",
                "updated_at": "2023-08-13T00:24:02.000000Z",
                "bank_account_name": "Adekunle Sewa Ayomide",
                "bank": "058",
                "bank_account_number": "0459076930",
                "is_payed": "true",
                "total_aff_sales_cash": "20000",
                "total_aff_sales": "4",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_zyj03kh7mat0hjj",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-08-06 19:11:39",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 222,
                "firstName": "SAMUEL MOSES",
                "lastName": "ADEYEMI",
                "email": "rubbiesreal@gmail.com",
                "email_code": "8223",
                "email_verified": 1,
                "password": "$2y$10$zPoZNCtx4YWSJqvDPnHyoe28\/i0WWiPxednKBoZxOCMJnztLWYo0K",
                "phone": "08108711189",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "bzxp32",
                "created_at": "2023-05-31T12:10:45.000000Z",
                "updated_at": "2023-06-01T18:51:52.000000Z",
                "bank_account_name": "SAMUEL MOSES ADEYEMI",
                "bank": "033",
                "bank_account_number": "2100416321",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_3g2bjx24ouk5zxg",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 223,
                "firstName": "Olooto",
                "lastName": "Nafiu dolapo",
                "email": "aburoyhaanukewu@gmail.com",
                "email_code": "4226",
                "email_verified": 1,
                "password": "$2y$10$08dgJZ5mwd2KHdmaFiZ6BOFXzlI\/cFRX8\/chgfk.ZLOC.5ayQaopm",
                "phone": "08145679566",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "pNKfdc",
                "created_at": "2023-05-31T12:15:07.000000Z",
                "updated_at": "2023-06-01T12:32:07.000000Z",
                "bank_account_name": "olooto dolapo nafiu",
                "bank": "033",
                "bank_account_number": "2124591255",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_6mh9k89rps8efpb",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 224,
                "firstName": "Oluwaseyi",
                "lastName": "Fabeku",
                "email": "olusykes07@gmail.com",
                "email_code": "7524",
                "email_verified": 1,
                "password": "$2y$10$rvkw2JMBRR6CVgceF9lWd.L9eax\/eCtnsbLOuk9KXq9fNrvWlxNga",
                "phone": "08082769413",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "8qNMQc",
                "created_at": "2023-05-31T12:21:22.000000Z",
                "updated_at": "2023-05-31T13:09:16.000000Z",
                "bank_account_name": "Oluwaseyi Fabeku",
                "bank": "070",
                "bank_account_number": "6555348049",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_psa7wryknvjqhf9",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 225,
                "firstName": "Okonkwo",
                "lastName": "Chinenye",
                "email": "okolynchi@gmail.com",
                "email_code": "3531",
                "email_verified": 1,
                "password": "$2y$10$Y0LMPxhgMuW43SmvOZHnke1yphM346R9Rtt4BJZC3iiRjO2kWOmDe",
                "phone": "07031252618",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "O8RwEN",
                "created_at": "2023-05-31T12:29:27.000000Z",
                "updated_at": "2023-05-31T20:00:20.000000Z",
                "bank_account_name": "Okonkwo Chinenye Lynda",
                "bank": "032",
                "bank_account_number": "0098048185",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_a7hc7eb2f2tcf5m",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 226,
                "firstName": "Esther",
                "lastName": "Nnamani",
                "email": "e8046310@gmail.com",
                "email_code": "3630",
                "email_verified": 1,
                "password": "$2y$10$4.EX88dHuaUPT3QE1IrZN.f2JlBiddtFYnvKAL7aA8EPCYcxjUc.K",
                "phone": "09050212718",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "FusarV",
                "created_at": "2023-05-31T12:38:10.000000Z",
                "updated_at": "2023-05-31T12:59:30.000000Z",
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
                "id": 227,
                "firstName": "Mercy",
                "lastName": "Chizoba",
                "email": "mercyohayere@gmail.com",
                "email_code": "6039",
                "email_verified": 1,
                "password": "$2y$10$TM8IYXDAgZgfCDNCOuTwbeYff682q0FaibQccnST.Gt.x4SSl7YTW",
                "phone": "09139024298",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "cmBPxz",
                "created_at": "2023-05-31T12:40:03.000000Z",
                "updated_at": "2023-11-04T21:11:17.000000Z",
                "bank_account_name": "Ohanyere Mercy",
                "bank": "057",
                "bank_account_number": "2171981681",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "5000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_0biye9nho963ayk",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-21 20:26:20",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 228,
                "firstName": "Omowunmi",
                "lastName": "Omowunmi",
                "email": "rokibatyusuf08@gmail.com",
                "email_code": "9683",
                "email_verified": 1,
                "password": "$2y$10$2SLPvmZjYVrS6Ag4W6XTGO7pCZOiAx3CaEIV8lGKiLb9YloBbqF\/a",
                "phone": "08142078980",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "VRvJXU",
                "created_at": "2023-05-31T13:01:44.000000Z",
                "updated_at": "2023-06-02T15:35:06.000000Z",
                "bank_account_name": "Yusuf Rokibat Omowunmi",
                "bank": "058",
                "bank_account_number": "0231739055",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_0pg7zg527tc31gs",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 229,
                "firstName": "Samuel",
                "lastName": "Nwankwo",
                "email": "nwankwochidoskysmart2025@gmail.com",
                "email_code": "5586",
                "email_verified": 1,
                "password": "$2y$10$msHVk4mbZ039Fb7cbEZg5.CvXNBH0bpOxQpJUXOdcPWvJMKHpLfb2",
                "phone": "09038789432",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "uj2Kak",
                "created_at": "2023-05-31T14:32:37.000000Z",
                "updated_at": "2023-11-05T00:41:31.000000Z",
                "bank_account_name": "Nwankwo Samuel Chidiebele",
                "bank": "058",
                "bank_account_number": "0760386915",
                "is_payed": "true",
                "total_aff_sales_cash": "375000",
                "total_aff_sales": "75",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_zza31st9p7casls",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-03 22:42:43",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 230,
                "firstName": "Sandra",
                "lastName": "Okorie",
                "email": "okoriesandra789@gmail.com",
                "email_code": "6220",
                "email_verified": 1,
                "password": "$2y$10$uE\/\/cFirDXx1z9ag1QpinuUh2zviI8TFUbBImkK4nTYyJDRS1OX8y",
                "phone": "08105909996",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Q9WegD",
                "created_at": "2023-05-31T14:37:55.000000Z",
                "updated_at": "2023-07-02T01:56:27.000000Z",
                "bank_account_name": "Sandra Chisom Okorie",
                "bank": "070",
                "bank_account_number": "6321580334",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_vlskgmouks5uk9h",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 231,
                "firstName": "Glory",
                "lastName": "Timothy",
                "email": "gloryt27@gmail.com",
                "email_code": "8156",
                "email_verified": 1,
                "password": "$2y$10$Ho.WUmIO.kNZjRawc8CvKOofwYxN613RW1jJG7EFE25PSKSRTUuKi",
                "phone": "08104480660",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Iil9F2",
                "created_at": "2023-05-31T15:34:17.000000Z",
                "updated_at": "2023-05-31T17:10:49.000000Z",
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
                "id": 232,
                "firstName": "Azametsi",
                "lastName": "Prince",
                "email": "azametsiprince3@gmail.com",
                "email_code": "6596",
                "email_verified": 1,
                "password": "$2y$10$64LC5Vl.GkEWV9\/vyg3Gte3vxa12U0QetvwpNJ7LcXTiVmGBZiuzO",
                "phone": "08140396166",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ScPtIv",
                "created_at": "2023-05-31T15:39:21.000000Z",
                "updated_at": "2023-05-31T21:18:19.000000Z",
                "bank_account_name": "Azametsi kweku prince",
                "bank": "068",
                "bank_account_number": "5001990563",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_7dmlkvmxcgplnhv",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 233,
                "firstName": "Roseline",
                "lastName": "Mbuks",
                "email": "roselineblessed8@gmail.com",
                "email_code": "9433",
                "email_verified": 1,
                "password": "$2y$10$WJYSKa2Svkp3jGexA53Xgu9FKUU\/cZo9NMtMUIWswI0V4378EuwDS",
                "phone": "08186472443",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "VqiMzu",
                "created_at": "2023-05-31T17:42:25.000000Z",
                "updated_at": "2023-05-31T18:24:58.000000Z",
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
                "id": 234,
                "firstName": "Abigail",
                "lastName": "Peter",
                "email": "petertaremiabigail@gmail.com",
                "email_code": "4082",
                "email_verified": 1,
                "password": "$2y$10$Pd0mVxvTRxmHkjsd6X9ClOi7hn4S102GcDmDHa9FXVP88RWmXjGAW",
                "phone": "09135640801",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "tPk39X",
                "created_at": "2023-05-31T18:00:36.000000Z",
                "updated_at": "2023-10-01T23:13:34.000000Z",
                "bank_account_name": "Peter Abigail Taremi",
                "bank": "063",
                "bank_account_number": "0075706288",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_vaibd4d8ru0frw7",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 235,
                "firstName": "Regina",
                "lastName": "kattey",
                "email": "rkatteyregina@gmail.com",
                "email_code": "8372",
                "email_verified": 1,
                "password": "$2y$10$Jg7co.8J7HJF09hAKzvki.hGs8YN2yOWV741GeHRn.OCNFz2uKCIy",
                "phone": "08138185224",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Cifewo",
                "created_at": "2023-05-31T18:19:34.000000Z",
                "updated_at": "2023-10-04T10:41:50.000000Z",
                "bank_account_name": "Regina kattey",
                "bank": "070",
                "bank_account_number": "6232737452",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ypjl6feretblfv1",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 236,
                "firstName": "Ani",
                "lastName": "Lucy",
                "email": "chidinmajoyce04@gmail.com",
                "email_code": "7700",
                "email_verified": 1,
                "password": "$2y$10$sLBtkZmN3fTazw8HUwbKK.bSzpqw96NxCfRwFgMDvAxVhoXsYd3.a",
                "phone": "09024090534",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "RsCetL",
                "created_at": "2023-05-31T18:33:40.000000Z",
                "updated_at": "2023-06-18T20:20:49.000000Z",
                "bank_account_name": "Ani chidimmalucy",
                "bank": "044",
                "bank_account_number": "1507642070",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_8f6wfaygyqvqr9c",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 237,
                "firstName": "Francisca",
                "lastName": "Nnaeto",
                "email": "franciscachinenye035@gmail.com",
                "email_code": "2931",
                "email_verified": 1,
                "password": "$2y$10$fz6kpBQHPL546p9nvdv4guM0r1iB\/8N\/tFEiVsdkvmDhBLxTxFBGS",
                "phone": "08037849642",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "QtBZ9z",
                "created_at": "2023-05-31T18:46:17.000000Z",
                "updated_at": "2023-05-31T20:24:38.000000Z",
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
                "id": 238,
                "firstName": "Mayowa",
                "lastName": "Azeez",
                "email": "futurecareer14@gmail.com",
                "email_code": "2907",
                "email_verified": 1,
                "password": "$2y$10$Y8NnrPGzSIb7Dv2SxeSidugu\/bySrSnQIR44lV5WMo4OM7JnAf.8W",
                "phone": "08057549578",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "qtJpV8",
                "created_at": "2023-05-31T18:48:17.000000Z",
                "updated_at": "2023-11-05T00:41:31.000000Z",
                "bank_account_name": "Mayowa Azeez",
                "bank": "058",
                "bank_account_number": "0030476720",
                "is_payed": "true",
                "total_aff_sales_cash": "90000",
                "total_aff_sales": "18",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_dzeq9xcb0cl66jw",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-02 07:22:42",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 239,
                "firstName": "Sunday",
                "lastName": "Ifiok",
                "email": "oluwawiskidom@gmail.com",
                "email_code": "2769",
                "email_verified": 1,
                "password": "$2y$10$TM\/9YiipP8vivUfKdgp\/ZOEZmTYujAxtAXbRMEdquBGRtqkW8G.d.",
                "phone": "09098583111",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "21EjM5",
                "created_at": "2023-05-31T19:44:49.000000Z",
                "updated_at": "2023-05-31T20:28:48.000000Z",
                "bank_account_name": "Ifiok Christopher Sunday",
                "bank": "999992",
                "bank_account_number": "9098583111",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_tvtu2xpt3xmtzmu",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 240,
                "firstName": "Ayanwale Lukman",
                "lastName": "Alade",
                "email": "alukmanalade@gmail.com",
                "email_code": "4693",
                "email_verified": 1,
                "password": "$2y$10$R833yHdBUQMKMdGO\/pB8a.aGjF1K\/9y4MLkTY\/PlWA6r8b1zMdQzK",
                "phone": "08136169601",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "X5ObFe",
                "created_at": "2023-05-31T20:01:18.000000Z",
                "updated_at": "2023-11-05T00:41:32.000000Z",
                "bank_account_name": "AYANWALE LUKMAN ALADE",
                "bank": "011",
                "bank_account_number": "3146966531",
                "is_payed": "true",
                "total_aff_sales_cash": "465000",
                "total_aff_sales": "93",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_oizrq9xjopaqcfw",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-02 19:20:42",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 241,
                "firstName": "Joachim Uchechukwu",
                "lastName": "Esimekara",
                "email": "uchezy2simple@gmail.com",
                "email_code": "3679",
                "email_verified": 1,
                "password": "$2y$10$AeuRshaUnkzHHsn5O4DWQeUlB0nA8jV1LXqD7SJscmZUT\/Ihrvrmm",
                "phone": "08189409945",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "aBGC80",
                "created_at": "2023-05-31T20:05:28.000000Z",
                "updated_at": "2023-06-01T19:26:08.000000Z",
                "bank_account_name": "Guaranty Trust Bank",
                "bank": "058",
                "bank_account_number": "0142517492",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_zlm6q4cr7s21dq5",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 242,
                "firstName": "Kehinde",
                "lastName": "Animasaun",
                "email": "animasaunkenny@gmail.com",
                "email_code": "4991",
                "email_verified": 1,
                "password": "$2y$10$Ocvzdc1P4xjenk.3t9apHuFOOEM4WBpDZ3esjXg0SZVivk64h910u",
                "phone": "08138101577",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "UdMLy2",
                "created_at": "2023-05-31T20:14:31.000000Z",
                "updated_at": "2023-06-01T21:44:20.000000Z",
                "bank_account_name": "Animasaun kehinde Mary",
                "bank": "058",
                "bank_account_number": "0350322703",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ma52q4bjdltzncb",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 243,
                "firstName": "Adesokan",
                "lastName": "Olayinka",
                "email": "adesokanolayinka1@gmail.com",
                "email_code": "8583",
                "email_verified": 0,
                "password": "$2y$10$zwVhjRcPU30eBm1qFvqBte7NN1ea9ZIoFQuSlxeEJeh7iLLC.F2MG",
                "phone": "08131330006",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "4IEUe5",
                "created_at": "2023-05-31T20:16:17.000000Z",
                "updated_at": "2023-06-21T11:53:12.000000Z",
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
                "id": 244,
                "firstName": "Saaloo",
                "lastName": "Godfirst",
                "email": "Saaloobarituaka@gmail.com",
                "email_code": "5607",
                "email_verified": 1,
                "password": "$2y$10$TUyGj\/K4WEW07F7dmlPn0uGNOekQCo3zk.yI0uPcyEmNGokeTmfNe",
                "phone": "09031305586",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "7R5drF",
                "created_at": "2023-05-31T20:17:20.000000Z",
                "updated_at": "2023-06-07T08:04:56.000000Z",
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
                "id": 245,
                "firstName": "Ekea",
                "lastName": "Jennifer",
                "email": "jenniferekea96@gmail.com",
                "email_code": "1960",
                "email_verified": 1,
                "password": "$2y$10$kg7sl6Bixc\/gRC.PFR2ziO1I3Qk9sIOg6YAQeMgmVVkMrUwYGUy6a",
                "phone": "08064557311",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "2rgjuX",
                "created_at": "2023-05-31T20:28:36.000000Z",
                "updated_at": "2023-06-06T14:55:35.000000Z",
                "bank_account_name": "Ekea jennifer ekere",
                "bank": "011",
                "bank_account_number": "3090006226",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_o0s66w0azhkncob",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 246,
                "firstName": "Kolawole",
                "lastName": "Ajike",
                "email": "ajikekolawole@gmail.com",
                "email_code": "1945",
                "email_verified": 1,
                "password": "$2y$10$UG\/TAOihHiZFgKRodX9See3S7v73gw6g6WwTE0LwY2\/oweJ7cFz76",
                "phone": "08032823186",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "kLRgKh",
                "created_at": "2023-05-31T20:31:17.000000Z",
                "updated_at": "2023-06-03T00:47:22.000000Z",
                "bank_account_name": "Ajike kolawole Samuel",
                "bank": "035",
                "bank_account_number": "0234995561",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_n0aglf1syhftms4",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 247,
                "firstName": "Peter",
                "lastName": "Ololade",
                "email": "peterololade13@gmail.com",
                "email_code": "2403",
                "email_verified": 1,
                "password": "$2y$10$CeQxjzRmVUvVjQQF251qNOIvX.cJmvTLnfSWtUkKaaoaFPH\/ZtSGe",
                "phone": "07045748183",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "JsZvV1",
                "created_at": "2023-05-31T20:46:37.000000Z",
                "updated_at": "2023-06-03T20:34:27.000000Z",
                "bank_account_name": "Peter Gbolagade Mathew",
                "bank": "999991",
                "bank_account_number": "7045748183",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_myqd1wmsxyfsp7a",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 248,
                "firstName": "Fatima",
                "lastName": "suleiman",
                "email": "suleimanusmanf@gmail.com",
                "email_code": "2496",
                "email_verified": 1,
                "password": "$2y$10$dYYvjtNI4YYdJr2jdBPV7ONIyNbn72DydTUhFgBWZTRDa8avcC3ca",
                "phone": "09022885370",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "DvdZXe",
                "created_at": "2023-05-31T21:00:13.000000Z",
                "updated_at": "2023-06-22T17:45:54.000000Z",
                "bank_account_name": "Fatima suleiman usman",
                "bank": "999991",
                "bank_account_number": "9022885370",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_swvzt341v595bk7",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 249,
                "firstName": "Ezulike",
                "lastName": "Christiana",
                "email": "chychyfaith8@gmail.com",
                "email_code": "7818",
                "email_verified": 1,
                "password": "$2y$10$stokfcDOCrljP..wkimL9eKqIqNSdu86rki.wm4p1h4sKTWWV0vwq",
                "phone": "08064264964",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "M9GZCH",
                "created_at": "2023-05-31T21:16:05.000000Z",
                "updated_at": "2023-06-03T21:08:23.000000Z",
                "bank_account_name": "Ezulike Christiana",
                "bank": "044",
                "bank_account_number": "0084675232",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_uvvxrxl7jial65i",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 250,
                "firstName": "EMMANUEL",
                "lastName": "OJO",
                "email": "ojop93102@gmail.com",
                "email_code": "6718",
                "email_verified": 1,
                "password": "$2y$10$a44dSMAjMirfFAU72ESbF.wLPZkWlssKgeyLb0FjYV7Ad.fnKioQC",
                "phone": "08146058733",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "JKWa6L",
                "created_at": "2023-05-31T21:29:40.000000Z",
                "updated_at": "2023-06-01T01:12:35.000000Z",
                "bank_account_name": "Ojo Emmanuel Pelumi",
                "bank": "044",
                "bank_account_number": "1566050355",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_npcwqlbj1tqou2e",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 251,
                "firstName": "Jimmy",
                "lastName": "Noabasiubong",
                "email": "noabasiubong.jimmy@icloud.com",
                "email_code": "9405",
                "email_verified": 1,
                "password": "$2y$10$5HjLDE\/\/YjJ9RnrFqYGNCuV0NMZjVj26JHx04aOziB4AJIINcyQBK",
                "phone": "09023356723",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "3iMe2u",
                "created_at": "2023-05-31T21:36:04.000000Z",
                "updated_at": "2023-06-05T07:53:38.000000Z",
                "bank_account_name": "Noabasiubong Akaka Jimmy",
                "bank": "033",
                "bank_account_number": "2299799979",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_xrcxoks1ov29a55",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 252,
                "firstName": "Enow",
                "lastName": "Betrand",
                "email": "enowbetino27@gmail.com",
                "email_code": "8035",
                "email_verified": 1,
                "password": "$2y$10$zJJyj.Vbot.7GMhBX490AuMPrS3b3pHgS6roC2Jj4o3flCn7Y5X.S",
                "phone": "+237651411349",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "fIPnT3",
                "created_at": "2023-05-31T21:46:20.000000Z",
                "updated_at": "2023-06-01T02:12:37.000000Z",
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
                "id": 253,
                "firstName": "Edna hussiana",
                "lastName": "Ogoh",
                "email": "ednaogoh@gmail.com",
                "email_code": "1310",
                "email_verified": 1,
                "password": "$2y$10$LjyyZEAnnry7UKNqVeqHEuJwJKHGR8INbFkhpvt5ExBiSNTKclxy2",
                "phone": "08163333971",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "3oxchS",
                "created_at": "2023-05-31T21:53:03.000000Z",
                "updated_at": "2023-06-21T18:03:14.000000Z",
                "bank_account_name": "Edna hussiana Ogoh",
                "bank": "033",
                "bank_account_number": "2148380013",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_dfuxo9itg3o3b5q",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 254,
                "firstName": "Abdulwasiu Idris",
                "lastName": "Olawale",
                "email": "abdulwasiuidris5@gmail.com",
                "email_code": "5297",
                "email_verified": 1,
                "password": "$2y$10$8TfwMaaTBfwuN1CbCqBgwu1YSvIjt7X0xzarqD8AEundQ4W6JgPua",
                "phone": "09064978577",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Bl6ncS",
                "created_at": "2023-05-31T22:00:42.000000Z",
                "updated_at": "2023-07-02T01:56:30.000000Z",
                "bank_account_name": "Idris Abdulwasiu",
                "bank": "101",
                "bank_account_number": "9600252945",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_mdaedps2eb8lsc0",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 255,
                "firstName": "Peace",
                "lastName": "Mustapha",
                "email": "mustafapeace2@gmail.com",
                "email_code": "8115",
                "email_verified": 1,
                "password": "$2y$10$YutN7yzaL7aNn49JVpVLxO4jlV7SxJ1Ygop6KMmm\/RYyZUNB21c9y",
                "phone": "08122590997",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "DP1kMv",
                "created_at": "2023-05-31T22:04:12.000000Z",
                "updated_at": "2023-06-01T19:43:25.000000Z",
                "bank_account_name": "Dayo Peace Mustafa",
                "bank": "058",
                "bank_account_number": "0441487593",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ytv6zmp5gw3yzz3",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 256,
                "firstName": "Olatunde",
                "lastName": "Olajolo",
                "email": "tunde.olajolo@gmail.com",
                "email_code": "5025",
                "email_verified": 1,
                "password": "$2y$10$Y16TLvs6qSlREMbV5fMIgu2DlhOKiN2zI1\/OoJfpiK8Q.B5nGBb3m",
                "phone": "+2348038492153",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Y5ephR",
                "created_at": "2023-05-31T22:11:23.000000Z",
                "updated_at": "2023-05-31T23:18:35.000000Z",
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
                "id": 257,
                "firstName": "sodiq ashiat",
                "lastName": "Adeola",
                "email": "sodiqashiat25@gmail.com",
                "email_code": "6196",
                "email_verified": 1,
                "password": "$2y$10$sHx.zpbsEALmoelKCpmC3.UTkMq5IOpcJ3umCy9hP.O.p2gFc6qCm",
                "phone": "09072600859",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "oYDf5B",
                "created_at": "2023-05-31T22:13:04.000000Z",
                "updated_at": "2023-05-31T22:27:57.000000Z",
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
                "id": 258,
                "firstName": "Ruth",
                "lastName": "Okeke",
                "email": "okekeruth702@gmail.com",
                "email_code": "8432",
                "email_verified": 1,
                "password": "$2y$10$.2JZQFADXeTk5Mvt5TNzKuGj93ezTaFny2RzHaLSubY8GgCNNX5BS",
                "phone": "08145694432",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "NfSuF2",
                "created_at": "2023-05-31T22:20:49.000000Z",
                "updated_at": "2023-06-01T19:52:55.000000Z",
                "bank_account_name": "Okeke Ruth Chukwuemerie",
                "bank": "033",
                "bank_account_number": "2086707772",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_yoh0jsku12rtjn7",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 259,
                "firstName": "Abdulrazaq Mujeeb",
                "lastName": "Aremu",
                "email": "abdrasaqmujeeb@gmail.com",
                "email_code": "4226",
                "email_verified": 1,
                "password": "$2y$10$jLZPCAe39mgWQKwyJxFrLucUNlNU8YYbyrEQgaSSqztJf3jvY\/ALi",
                "phone": "09068459071",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "0MvijO",
                "created_at": "2023-05-31T22:24:48.000000Z",
                "updated_at": "2023-05-31T23:23:03.000000Z",
                "bank_account_name": "Abdulrazaq Mujeeb Aremu",
                "bank": "057",
                "bank_account_number": "2263668247",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_k8sjwlgps32ih87",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 260,
                "firstName": "Jeremiah",
                "lastName": "Mbah",
                "email": "jeremiahokonbello@gmail.com",
                "email_code": "3905",
                "email_verified": 1,
                "password": "$2y$10$2HiEr0BZQXcdqv7EZxQFTeTQj8YuOVHycoOoReMkGWU4rzubojCWe",
                "phone": "+237653720664",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "JMwt8k",
                "created_at": "2023-05-31T22:31:17.000000Z",
                "updated_at": "2023-06-01T11:45:46.000000Z",
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
                "id": 261,
                "firstName": "Ogochukwu",
                "lastName": "Nzelu",
                "email": "nzeluogochukwu@gmail.com",
                "email_code": "4438",
                "email_verified": 1,
                "password": "$2y$10$bXg3fWV0zuHrxnb6vx6Q5up.TpGdi9JBS0YrkjNaQE\/GuXPo\/Lotq",
                "phone": "08068748750",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "AGZWCH",
                "created_at": "2023-05-31T22:37:28.000000Z",
                "updated_at": "2023-06-11T13:04:46.000000Z",
                "bank_account_name": "Nzelu ogochukwu chioma",
                "bank": "057",
                "bank_account_number": "2117473195",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_c0u5bc07kjvu2jd",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 262,
                "firstName": "Collins",
                "lastName": "Nima",
                "email": "kingbene757@gmail.com",
                "email_code": "2080",
                "email_verified": 1,
                "password": "$2y$10$Q4GrCjEZgmwAXLZYK2Hwq.gYeYx1RskzIK1oqMbbdBOfNC0V81OT2",
                "phone": "08129339127",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "V7FYgI",
                "created_at": "2023-05-31T22:40:38.000000Z",
                "updated_at": "2023-06-01T09:28:39.000000Z",
                "bank_account_name": "COLLINS NIMA",
                "bank": "032",
                "bank_account_number": "0129810657",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_5iez9uhnh57o85j",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 263,
                "firstName": "Vivian",
                "lastName": "Ilotonti",
                "email": "egovilo@gmail.com",
                "email_code": "7225",
                "email_verified": 1,
                "password": "$2y$10$9EAS6adfGviBTMcLW8VMp.daobCB7fugOXJMRPfc.BDOcYMW50QQq",
                "phone": "08031381871",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "GLgeJ6",
                "created_at": "2023-05-31T22:44:21.000000Z",
                "updated_at": "2023-06-01T15:38:18.000000Z",
                "bank_account_name": "Guaranty Trust Bank",
                "bank": "058",
                "bank_account_number": "0165983847",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_11desz7lv9vc2h9",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 264,
                "firstName": "Chinecherem. Perpetual",
                "lastName": "Okonkwo",
                "email": "okonkwoneche1999@gmail.com",
                "email_code": "3714",
                "email_verified": 1,
                "password": "$2y$10$9X49VuAQ8wNY9gjoqmwC9uSCmahuxKwlnNd1iBgvPVKngN0MnOgUC",
                "phone": "09069146549",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "aOnX3T",
                "created_at": "2023-05-31T22:47:36.000000Z",
                "updated_at": "2023-06-01T15:38:19.000000Z",
                "bank_account_name": "Okonkwo chinecherem perpetual",
                "bank": "057",
                "bank_account_number": "2117376409",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_nummoj09kim1qjl",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 265,
                "firstName": "Fathia",
                "lastName": "Adenekan",
                "email": "adenekanfathia82@gmail.com",
                "email_code": "9021",
                "email_verified": 1,
                "password": "$2y$10$WFEWvFp6PoItzRlS.T.Pxedrc\/NXwwwXCuGUt20U7C445hJmlc542",
                "phone": "09124492825",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "e4PLVd",
                "created_at": "2023-05-31T22:51:22.000000Z",
                "updated_at": "2023-05-31T23:10:08.000000Z",
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
                "id": 266,
                "firstName": "Chidinma",
                "lastName": "Obot",
                "email": "ucoogb@yahoo.com",
                "email_code": "4280",
                "email_verified": 1,
                "password": "$2y$10$AyLaTQMbEQc.PA0118y6seddzYNGVXPfH\/MrB\/WgJDQUcmXkG8RQS",
                "phone": "08039346887",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "erQE5Z",
                "created_at": "2023-05-31T22:56:05.000000Z",
                "updated_at": "2023-06-02T10:52:05.000000Z",
                "bank_account_name": "Zenith",
                "bank": "057",
                "bank_account_number": "2005265769",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_jdjii8gp5it4qby",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 267,
                "firstName": "Judith",
                "lastName": "Mbah",
                "email": "chidimmajudith806@gmail.com",
                "email_code": "2943",
                "email_verified": 1,
                "password": "$2y$10$ju\/i4H2K.8o9nEuGx8ip2eW0kw.4nbQidTfEH3JA\/Iy1x9WYSx4eW",
                "phone": "08146401759",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "IVFy5x",
                "created_at": "2023-05-31T22:59:30.000000Z",
                "updated_at": "2023-06-01T02:16:59.000000Z",
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






