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

    Route::delete('account/remove/{id}', function ($id) {
        $user = Members::destroy($id);

        return response()->json(["message" => "successfully deletd"]);
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

   Route::get('view/product/{id}', function ($id) {
    $user = Products::find($id);

    $user->image = asset('https://zenithstake.syncight.com/storage/images/product_images/' . $user->image);

    return response()->json($user);
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

    $sales = Sales::where('vendor_id', $vendor_id)->limit(200)->get();
    
            for($i=0; $i<count($sales); $i++){
                
                $affiliate = Members::where('affiliate_id', $sales[$i]->affiliate_id)->first();

                if($affiliate){
                    $sales[$i]->affiliate_details = $affiliate;

                }else
                {
                    $sales[$i]->affiliate_details = "kdsjbc";
                }

           
            }

            // Input array
$arr = $sales;
  
  // Initialize an associative array to keep track of counts
  $countById = array();
  
  // Loop through the array and count items with the same id
  foreach ($arr as $item) {
    $id = $item["id"];
    if (isset($countById[$id])) {
      $countById[$id]++;
    } else {
      $countById[$id] = 1;
    }
  }
  
  // Output array with counts added
  $outputArr = array();
  foreach ($arr as $item) {
    $id = $item["id"];
    $count = $countById[$id];
    if ($count > 1) {
      $item["count"] = $count;
    }
    $outputArr[] = $item;
  }
  
  // Output the result
  print_r($outputArr);
  

            return response()->json($outputArr);



});

