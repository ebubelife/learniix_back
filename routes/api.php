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
                "id": 1,
                "firstName": "Chinaza",
                "lastName": "Temple",
                "email": "aimchinaza3039@gmail.com",
                "email_code": "2357",
                "email_verified": 1,
                "password": "$2y$10$U9qSCnPFDNEnBI22TAcZEeWGNghNQhFmNCyiyZYDTlQEk4ICmMmHi",
                "phone": "09071877825",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "YPhCRf",
                "created_at": "2023-05-26T02:53:30.000000Z",
                "updated_at": "2023-09-22T19:09:05.000000Z",
                "bank_account_name": "Godspower Temple",
                "bank": "035",
                "bank_account_number": "8540756999",
                "is_payed": "true",
                "total_aff_sales_cash": "690000",
                "total_aff_sales": "138",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_kl98oq1n1mrxqyg",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-08-10 08:25:33",
                "last_sale_product": "1",
                "currency": "NGN"
            },
            {
                "id": 16,
                "firstName": "Zenithstake",
                "lastName": "Zenithstake",
                "email": "zenithstake@gmail.com",
                "email_code": "2309",
                "email_verified": 1,
                "password": "$2y$10$wBzPBxwyNIu0LEIPN8m0O.KTVqh.ZFjloTL2wxZMlvY1gEyGLI3KW",
                "phone": "09071977825",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 1,
                "affiliate_id": "KuibvT",
                "created_at": "2023-05-26T21:01:42.000000Z",
                "updated_at": "2023-11-08T07:24:11.000000Z",
                "bank_account_name": "ZENITHSTAKE ENTERPRISES",
                "bank": "035",
                "bank_account_number": "0124565836",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0",
                "total_vendor_sales_cash": "26940008",
                "total_vendor_sales": "6696",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "1694000",
                "payment_reference_paystack": "RCP_mpig030i1ia6wis",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            },
            {
                "id": 17,
                "firstName": "Nonso Joshua",
                "lastName": "Aniebo",
                "email": "nonsojoshua001@gmail.com",
                "email_code": "1174",
                "email_verified": 1,
                "password": "$2y$10$fliUVAfbhMu4zAZ49yhAVeodMaz7EyYZy0lLzTNyKskEQZoyUT982",
                "phone": "09031800356",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "3Cjyta",
                "created_at": "2023-05-26T23:39:38.000000Z",
                "updated_at": "2023-11-05T00:41:25.000000Z",
                "bank_account_name": "Nonso  Aniebo",
                "bank": "101",
                "bank_account_number": "9607651303",
                "is_payed": "true",
                "total_aff_sales_cash": "210000",
                "total_aff_sales": "42",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_oee0ob1ua3v0wr6",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-01 15:44:46",
                "last_sale_product": "1",
                "currency": "NGN"
            },
            {
                "id": 20,
                "firstName": "John",
                "lastName": "Adetunji",
                "email": "johnadetunji92@gmail.com",
                "email_code": "5762",
                "email_verified": 1,
                "password": "$2y$10$0zzhvZML\/zkNwWM3T.jfSudXWZzzOEo0OcrW6R3NYmHEjztVMdqq2",
                "phone": "07062284746",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "ndFPKg",
                "created_at": "2023-05-27T06:58:23.000000Z",
                "updated_at": "2023-10-01T00:05:21.000000Z",
                "bank_account_name": "John Adetunji",
                "bank": "044",
                "bank_account_number": "0724942497",
                "is_payed": "true",
                "total_aff_sales_cash": "75000",
                "total_aff_sales": "15",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_f3ka4qmjgo0cj6k",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-09-29 06:54:35",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 21,
                "firstName": "David",
                "lastName": "Adeleye",
                "email": "belovedprinz@gmail.com",
                "email_code": "9857",
                "email_verified": 1,
                "password": "$2y$10$HWw0Nq.eqBzLITnDjp0PhuJwmtrABTUZrFUgi8a8YYFQrvuyq7G1C",
                "phone": "09070801158",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "rD2wvH",
                "created_at": "2023-05-27T09:05:59.000000Z",
                "updated_at": "2023-09-23T23:25:37.000000Z",
                "bank_account_name": "David Adeleye",
                "bank": "050",
                "bank_account_number": "4751075725",
                "is_payed": "true",
                "total_aff_sales_cash": "15000",
                "total_aff_sales": "3",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ymh3zl055y441bu",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-09-18 04:56:59",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 22,
                "firstName": "CLEMENTINA",
                "lastName": "OYINKOLADE",
                "email": "tinaoyinkolade32@gmail.com",
                "email_code": "9167",
                "email_verified": 1,
                "password": "$2y$10$z.tX40VKr29Drjhj1b8D0OjkM.ahmbQ4qPPXkqMl.OPzRwwfteVpq",
                "phone": "08107819471",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Ozv3Fk",
                "created_at": "2023-05-27T10:02:08.000000Z",
                "updated_at": "2023-08-20T07:41:55.000000Z",
                "bank_account_name": "Clementina kofo Oyinkolade",
                "bank": "035",
                "bank_account_number": "7820964704",
                "is_payed": "true",
                "total_aff_sales_cash": "60000",
                "total_aff_sales": "12",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_vfuiw4etgip4yyr",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-08-17 15:14:45",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 24,
                "firstName": "Blessing",
                "lastName": "Ochiemen",
                "email": "blessingochiemen01@gmail.com",
                "email_code": "8454",
                "email_verified": 1,
                "password": "$2y$10$mv4JfvDKc1k7cP1tsK27netloI6doDvh\/Y9dnsrXWGGR8DNPxQX\/6",
                "phone": "814 241 6812",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "PIEBAp",
                "created_at": "2023-05-27T13:48:38.000000Z",
                "updated_at": "2023-11-05T00:41:26.000000Z",
                "bank_account_name": "Blessing Ochiemen",
                "bank": "050",
                "bank_account_number": "0891045961",
                "is_payed": "true",
                "total_aff_sales_cash": "85000",
                "total_aff_sales": "17",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_askrx31mvzcgwt6",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-10-30 07:14:05",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 41,
                "firstName": "Miracle",
                "lastName": "Patricks",
                "email": "miraclepatricks01@gmail.com",
                "email_code": "4804",
                "email_verified": 1,
                "password": "$2y$10$rdiJ7u5GjkEsyBsKbkwVm.aC2DhKwbTOxOQXbMShPRjKdXljpj51C",
                "phone": "09162735523",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 1,
                "affiliate_id": "xUDIlg",
                "created_at": "2023-05-28T16:46:49.000000Z",
                "updated_at": "2023-09-17T06:22:04.000000Z",
                "bank_account_name": "Akpokomuaye Miracle",
                "bank": "011",
                "bank_account_number": "3144612982",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0",
                "total_vendor_sales_cash": "8000",
                "total_vendor_sales": "1",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_7z210nvedycua02",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 42,
                "firstName": "Faithfulness",
                "lastName": "Oko-ose",
                "email": "ofureokoose@gmail.com",
                "email_code": "2135",
                "email_verified": 1,
                "password": "$2y$10$1BDij6P0nTBhQdu4MR6VDeu7zJRzXCdXuD3U8g.SuOmIk7E0tH77u",
                "phone": "08066501432",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "YxcRGf",
                "created_at": "2023-05-28T20:37:15.000000Z",
                "updated_at": "2023-11-07T18:32:26.000000Z",
                "bank_account_name": "Oko-ose Faithfulness Ofure",
                "bank": "033",
                "bank_account_number": "2096898710",
                "is_payed": "true",
                "total_aff_sales_cash": "1075000",
                "total_aff_sales": "215",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "55000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_03n31jfi56fh194",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-07 18:32:26",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 43,
                "firstName": "Promise",
                "lastName": "Ngozika",
                "email": "promisengozika2021@gmail.com",
                "email_code": "8721",
                "email_verified": 1,
                "password": "$2y$10$KRnf.Xhozjd6WUHokEze5.2X175wcoz3pT3AEneW6zrslhve8fNma",
                "phone": "08148106833",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "8YGrs3",
                "created_at": "2023-05-28T20:37:23.000000Z",
                "updated_at": "2023-11-07T22:58:00.000000Z",
                "bank_account_name": "Nome Promise Ngozika",
                "bank": "044",
                "bank_account_number": "0060225635",
                "is_payed": "true",
                "total_aff_sales_cash": "2420000",
                "total_aff_sales": "484",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "75000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_ffh0xbxz7autmd5",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-07 22:58:00",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 44,
                "firstName": "PRECIOUS",
                "lastName": "OGUNLEYE",
                "email": "holuwasayofunmiprecious@gmail.com",
                "email_code": "4355",
                "email_verified": 1,
                "password": "$2y$10$fXKpI56IZ0qm4pqVMTR30OT5uXLEqK6UpYu.WiCh3wBN8AGELKQKG",
                "phone": "09133612100",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "27CPNL",
                "created_at": "2023-05-28T21:05:26.000000Z",
                "updated_at": "2023-11-06T18:47:45.000000Z",
                "bank_account_name": "OGUNLEYE PRECIOUS OLUWASAYO",
                "bank": "058",
                "bank_account_number": "0161724398",
                "is_payed": "true",
                "total_aff_sales_cash": "4885000",
                "total_aff_sales": "977",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "105000",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_glre43d6mk2hy5d",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-06 18:47:45",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 45,
                "firstName": "Rukevwe",
                "lastName": "Ikolomi",
                "email": "ikolomirukevwe@gmail.com",
                "email_code": "7415",
                "email_verified": 1,
                "password": "$2y$10$BL6E0IAk3k0c2KNaISCpnOLiAU1UorENLvTRja\/shsaNVRQal8nj2",
                "phone": "07064695582",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "Ck5jK3",
                "created_at": "2023-05-28T21:21:54.000000Z",
                "updated_at": "2023-09-03T06:54:05.000000Z",
                "bank_account_name": "Rukevwe Ikolomi",
                "bank": "057",
                "bank_account_number": "2414953211",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_otcqo31hsmmmfzs",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-08-31 07:53:09",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 46,
                "firstName": "OBED",
                "lastName": "LEVI",
                "email": "leviobed2@gmail.com",
                "email_code": "3932",
                "email_verified": 1,
                "password": "$2y$10$hVGyAU0PIPSRKyTOUNf.beewvN7KkAIXcK1pjJ7nDCQv19eOjRj8C",
                "phone": "09050218813",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "xkLEuK",
                "created_at": "2023-05-28T21:22:10.000000Z",
                "updated_at": "2023-05-28T21:41:42.000000Z",
                "bank_account_name": "OBED LEVI",
                "bank": "033",
                "bank_account_number": "2217664451",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_25g7mn334fnttfz",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 47,
                "firstName": "Sarah",
                "lastName": "Abolarinwa",
                "email": "sarahifeoluwa777@gmail.com",
                "email_code": "3879",
                "email_verified": 1,
                "password": "$2y$10$FLbAGZ9wXBaQ4vSt04YYnuvpzng7TvfQ5Q2Hoowlp7WONzyjnUjMy",
                "phone": "08123297011",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "uBZaMp",
                "created_at": "2023-05-28T21:30:44.000000Z",
                "updated_at": "2023-05-29T19:36:04.000000Z",
                "bank_account_name": "Abolarinwa Sarah Oluwseun",
                "bank": "044",
                "bank_account_number": "1505230743",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_e3rmjk2z7ddk78e",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 48,
                "firstName": "Paul",
                "lastName": "Raphael",
                "email": "rapflames100@gmail.com",
                "email_code": "8495",
                "email_verified": 1,
                "password": "$2y$10$nbblqQEYI3gtKzNDo5y2cum51mm4GrZZwe09AOq1Q\/VEdn.mDv7Y2",
                "phone": "09031475628",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "3FvOLS",
                "created_at": "2023-05-28T21:33:43.000000Z",
                "updated_at": "2023-11-05T00:41:28.000000Z",
                "bank_account_name": "RAPHAEL PAUL",
                "bank": "033",
                "bank_account_number": "2259179955",
                "is_payed": "true",
                "total_aff_sales_cash": "160000",
                "total_aff_sales": "32",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_zo4re06ryfy77wk",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-11-03 19:17:08",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 49,
                "firstName": "Nwafor",
                "lastName": "Emmanuella",
                "email": "emmanuellanwafor06@gmail.com",
                "email_code": "6957",
                "email_verified": 1,
                "password": "$2y$10$nqHkIbXd5Xq11.zUE\/BVFuhB3AqSbaFsR3eBGQ6qvNf.W7gNsQVRy",
                "phone": "08119213148",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "RtmSkQ",
                "created_at": "2023-05-28T21:36:17.000000Z",
                "updated_at": "2023-08-20T07:41:57.000000Z",
                "bank_account_name": "Nwafor Uchechukwu Emmanuella",
                "bank": "044",
                "bank_account_number": "0804750778",
                "is_payed": "true",
                "total_aff_sales_cash": "195000",
                "total_aff_sales": "39",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_fvqw624kus3o87n",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": "5000",
                "last_sale_time": "2023-08-14 23:31:15",
                "last_sale_product": "1",
                "currency": "NGN"
            }, {
                "id": 50,
                "firstName": "Benedicta",
                "lastName": "Aghomon",
                "email": "aghomonbenedicta05@gmail.com",
                "email_code": "6319",
                "email_verified": 1,
                "password": "$2y$10$WGIu996Tk7ejbPljQgPhsu9PmgawNVR7WVtI\/u.Jpo9y9JlmcldEW",
                "phone": "09160832242",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "3U7Jjc",
                "created_at": "2023-05-28T22:04:24.000000Z",
                "updated_at": "2023-06-07T01:09:38.000000Z",
                "bank_account_name": "Aghomon Benedicta kehinde",
                "bank": "057",
                "bank_account_number": "2274204892",
                "is_payed": "true",
                "total_aff_sales_cash": "5000",
                "total_aff_sales": "1",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_beuc7nycpkdh4az",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 51,
                "firstName": "victor",
                "lastName": "Chukwuemeka",
                "email": "victorgeny330@gmail.com",
                "email_code": "8544",
                "email_verified": 1,
                "password": "$2y$10$KuCnXOMNuafC2P9UDD6oW.LuWGwndL5I6ki71Ks8LOyjvYsYITOXS",
                "phone": "08139724219",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "j3v4N8",
                "created_at": "2023-05-28T22:17:06.000000Z",
                "updated_at": "2023-08-26T16:46:25.000000Z",
                "bank_account_name": "Chukwuemeka victor obasi",
                "bank": "057",
                "bank_account_number": "2255513351",
                "is_payed": "true",
                "total_aff_sales_cash": "10000",
                "total_aff_sales": "2",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_djvjbm4ibyulf0b",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 0,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 52,
                "firstName": "JONAH",
                "lastName": "MUAZA",
                "email": "liftedjonah10@gmail.com",
                "email_code": "3279",
                "email_verified": 1,
                "password": "$2y$10$6\/3059\/xwcLnhHBTELi5leSW7ImVNfLxjnV9yNBXlk4e2T6xZhtAO",
                "phone": "09166384749",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "HJa27x",
                "created_at": "2023-05-28T22:21:19.000000Z",
                "updated_at": "2023-05-28T23:03:23.000000Z",
                "bank_account_name": "MUAZA JONAH KPENYIZE",
                "bank": "999992",
                "bank_account_number": "9049492563",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_dj9m2wji7o3qvo4",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 53,
                "firstName": "Amos",
                "lastName": "Upie",
                "email": "amosupie96@gmail.com",
                "email_code": "5184",
                "email_verified": 1,
                "password": "$2y$10$eBwYUhvRrtpo9K0P97lutOR4npqpczgdsk6\/\/NyOfOB0XC6v2mq2W",
                "phone": "09020447552",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "UsN1Kd",
                "created_at": "2023-05-28T22:33:20.000000Z",
                "updated_at": "2023-05-29T11:46:24.000000Z",
                "bank_account_name": "Amos Upie Ochiwu",
                "bank": "999992",
                "bank_account_number": "9020447552",
                "is_payed": "true",
                "total_aff_sales_cash": "0.00",
                "total_aff_sales": "0.00",
                "total_vendor_sales_cash": "0.00",
                "total_vendor_sales": "0",
                "unpaid_balance": "0.00",
                "unpaid_balance_vendor": "0.00",
                "payment_reference_paystack": "RCP_nua9uw62h95eq6f",
                "payment_reference_flutterwave": null,
                "weekly_withdrawal": "1",
                "withdrawal_settings": 1,
                "last_sale_amount": null,
                "last_sale_time": null,
                "last_sale_product": null,
                "currency": "NGN"
            }, {
                "id": 54,
                "firstName": "Oluchi",
                "lastName": "Philips",
                "email": "oluchiphilips05@gmail.com",
                "email_code": "5296",
                "email_verified": 1,
                "password": "$2y$10$eNpcmNCzro7mAus6D30QGeot1kd2ih9bghDFS07WwQBgvmFH7FnYW",
                "phone": "07067280101",
                "phone_code": null,
                "phone_verified": 0,
                "is_vendor": 0,
                "affiliate_id": "a2LJEX",
                "created_at": "2023-05-28T22:43:14.000000Z",
                "updated_at": "2023-05-28T22:47:39.000000Z",
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
    
            foreach ($json as $data) {
                $id = $data['id'];
                $totalAffSalesCash = $data['total_aff_sales_cash'];

                $user = Members::find($data['id']);

                $user->total_aff_sales_cash = $totalAffSalesCash;

                $user->save();
    
                // Update the MySQL database column using Eloquent
               // Members::where('id', $id)->update(['total_aff_sales_cash' => $totalAffSalesCash]);
            }
    
            return response()->json(['message' => ' updated successfully   '.$totalAffSalesCash], 200);
       





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






