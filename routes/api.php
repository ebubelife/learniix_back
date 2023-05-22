<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\SalesController;
use App\Models\Members;
use App\Models\Vendors;
use App\Models\Products;
use App\Models\Sales;
use Carbon\Carbon;

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

    Route::get('transactions/view/affiliate_payments', function () {
        $affiliate_payments = Transactions::where('tx_type', 'AFFILIATE_PAYMENT')
        ->orderByDesc('created_at')
        ->get();
    
        return response()->json( $affiliate_payments);
    });

    Route::get('transactions/view/vendor_payments', function () {
        $vendor_payments = Transactions::where('tx_type', 'VENDOR_PAYMENT')
        ->orderByDesc('created_at')
        ->get();
    
        return response()->json( $vendor_payments);
    });

    Route::post('pay/affiliates', 'pay_affiliates');

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
    //Route::get('view/user/{id}', 'view_user');
    Route::get('view/all', 'show');

    Route::get('view/affiliates', function () {
        $affiliates = Members::where('is_vendor', false)
        ->orderByDesc('created_at')
        ->get();
    
        return response()->json( $affiliates);
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
        return response()->json(["message" => "successfully update"]);
    });


    Route::get('users/all/update_payed_status', function () {
       // Members::query()->update(['is_payed' => ]);
        return response()->json(["message" => "successfully updated"]);
    });

    Route::get('account/remove/{id}', function ($id) {
        $user = Members::destroy($id);

        return response()->json(["message" => "successfully deleted"]);
    });

    Route::post('member/update','update');

    Route::post('account/verify_code','verify_code');
    Route::post('account/change_password','change_password');

    Route::post('account/confirm_email','send_mail_verify_code');

    Route::post('account/verify_email','verify_email_with_code');

   

    
   
  
   // Route::middleware('auth:sanctum')-> post('set_transaction_pin','set_transaction_pin');
   
   // Route::get('test_api','test_api');
});
//Vendors queries

Route::controller(VendorsController::class)->group(function(){

    
 
  
    Route::post('vendors/create','store');
   
   // Route::middleware('auth:sanctum')-> post('set_transaction_pin','set_transaction_pin');
   
   // Route::get('test_api','test_api');

   Route::get('view/vendor/{id}', function ($id) {
    $user = Vendors::find($id);

    return response()->json($user);
});


Route::get('vendors/view', function () {
    $vendors = Vendors::all();



    for($i=0; $i < count($vendors); $i++){

        $user = Members::find($vendors[$i]['vendor_id']);

        $vendors[$i]['vendor_details'] = $user;
        $vendors[$i]["image_path"] = asset('https://zenithstake.syncight.com/storage/images/vendor_images/' . $vendors[$i]["image"]);

    }

    return response()->json($vendors);
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
  
    Route::post('banks/add','store');
    Route::get('banks/view','show');
  
});

Route::controller(SalesController::class)->group(function(){
  
    Route::post('sales/add','store');
    Route::get('sales/view','show');
    Route::get('view/sale/{id}', function ($id) {
        $sale = Sales::find($id);
    
        return response()->json($sale);
    });


    //get affiliate_sales in last 24 hours

    Route::get('sales/today/affiliate/{affiliate_id}', function ($affiliate_id) {
        $startDateTime = Carbon::now()->subDay(); // Get the date and time 24 hours ago
        $endDateTime = Carbon::now(); // Get the current date and time
    
        $sales = Sales::where('affiliate_id', $affiliate_id)
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->get();
    
        return response()->json($sales);
    });


    //get vendor sales in last 24 hours

    Route::get('sales/today/vendor/{vendor_id}', function ($vendor_id) {
        $startDateTime = Carbon::now()->subDay(); // Get the date and time 24 hours ago
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



Route::get('admin_sales/view', function () {

    $sales = Sales::all();

    $total_sales = 0;

    $total_revenue = 0;

    foreach($sales as $sale){
        $total_sales += intval($sale->product_price);


    }

     $startDateTime = Carbon::now()->subDay(); // Get the date and time 24 hours ago
        $endDateTime = Carbon::now(); // Get the current date and time
    
        $sales_today = Sales::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->get();


            $total_earnings_today = 0;
            foreach($sales_today as $sale_today){
                $total_earnings_today  += intval($sale_today->product_price);
        
        
            }
    


    return response()->json(["total_earnings"=>$total_sales,"sales_today"=>count($sales_today),"total_earnings_today"=>$total_earnings_today]);


});






