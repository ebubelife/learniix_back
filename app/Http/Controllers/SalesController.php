<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Members;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        try{


            $validated = $request->validate([
            'vendor_id' => 'required|string',
            'affiliate_id' => 'required|string',
            'product_id' => 'required|string',
            'product_price' => 'required|string',
            'commission' => 'required|string',
             'tx_id' => 'required|string',
            'customer_name' => 'required|string',
            'customer_email' => 'required|string',
            'customer_phone' => 'required|string',
           
        ]);

             $sale = new Sales();

            
             $sale->affiliate_id =  $validated["affiliate_id"];
             $sale->product_id =  $validated["product_id"];
             $sale->product_price =  $validated["product_price"];
             $sale->commission =  $validated["commission"];
        
             $sale->customer_name =  $validated["customer_name"];
             $sale->customer_email =  $validated["customer_email"];
             $sale->customer_phone =  $validated["customer_phone"];
             $sale->vendor_id =  $validated["vendor_id"];


           /// $characters = '0123456789abcdefghijklmnopqrstuvwxyz' ;
            //$random_string = substr(str_shuffle($characters), 0, 8);
            $sale->tx_id = $validated["tx_id"];
            $sale->save();

            //calculate total affiliate sales column and add


            $user = Members::where('affiliate_id', $validated["affiliate_id"])->first();

            $commission_int = intval($validated["commission"]);
            $price_int = intval($validated["product_price"]);
            $total_aff_sales = intval($user->total_aff_sales_cash);
            $total_aff_sales_num = intval($user->total_aff_sales);

            $user->total_aff_sales_cash = strval((($commission_int/100) * $price_int)  + $total_aff_sales);
            $user->total_aff_sales = strval($total_aff_sales_num + 1);

            $unpaid_balance_affiliate = intval($user->unpaid_balance);

             $user->unpaid_balance = strval($unpaid_balance_affiliate + ((($commission_int/100) * $price_int)  + $total_aff_sales));


            $user->save();


            //calculate total vendor salles column


            $user = Members::where('id', $validated["vendor_id"])->first();

            $commission_int = intval($validated["commission"]);
            $price_int = intval($validated["product_price"]);

            $aff_commision = (($commission_int/100) * $price_int);
            $zenithstake_commision = ((10/100) * $price_int);

            $vendor_comission = ($price_int - $aff_commision) - $zenithstake_commision;

            $total_vendor_sales = intval($user->total_vendor_sales_cash);
            $total_vendor_sales_num = intval($user->total_vendor_sales);

            $unpaid_balance_vendor = intval($user->unpaid_balance_vendor);

            $user->total_vendor_sales_cash = strval($vendor_comission + $total_aff_sales);
            $user->total_vendor_sales = strval($total_vendor_sales_num + 1);

            $user->unpaid_balance_vendor = strval($unpaid_balance_vendor + ($vendor_comission + $total_aff_sales));



            $user->save();
    }
    catch(\Exception $e){
        return response()->json(['message'=>'An error occured, please try again', 'error'=>$e],405);


    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
          //
          $sales = Sales::all();
          return response()->json($sales);
    }


    public function show_affiliate_sales_from_date(Request $request){

      

      /*  $sale = new Sales();

            
        $sale->affiliate_id =  $validated["affiliate_id"];
        $sale->from_date =  $validated["from_date"];
        $sale->to_date =  $validated["to_date"];*/


        try{

            $validated = $request->validate([
                'affiliate_id' => 'required|string',
                'from_date' => 'required|string',
                'to_date' => 'required|string',
                'selected_product' => 'required|string',
               
               
            ]);

        $from = $validated["from_date"];
        $to = $validated["to_date"];

        if($validated["selected_product"] == ''){
            $sales_by_user = Sales::where('affiliate_id', "25vfgo")
            ->where('created_at', '>=', Carbon::parse($from))
            ->where('created_at', '<=', Carbon::parse($to))
            ->get();

        }else{

            $sales_by_user = Sales::where('affiliate_id', $validated["affiliate_id"])
            ->where('created_at', '>=', Carbon::parse($from))
            ->where('created_at', '<=', Carbon::parse($to))
            ->where('product_id', $validated["selected_product"])
            ->get();

        }
      


                        return response()->json(["message"=>$sales_by_user, "to"=>$to, "from"=>$from]);

        }
        catch(\Exception $e){
            return response()->json(['message'=>'An error occured, please try again', 'error'=>$e],405);
    
    
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        //
    }
}
