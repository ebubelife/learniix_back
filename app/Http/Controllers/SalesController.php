<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Members;
use Illuminate\Http\Request;

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

            $user->total_aff_sales_cash = (($commission_int/100) * $price_int)  + $total_aff_sales;
            $user->total_aff_sales = $total_aff_sales_num + 1;

            $user->save();


            //calculate total vendor salles column


            $user = Members::where('vendor_id', $validated["vendor_id"])->first();

            $commission_int = intval($validated["commission"]);
            $price_int = intval($validated["product_price"]);

            $aff_commision = (($commission_int/100) * $price_int);
            $zenithstake_commision = ((10/100) * $price_int);

            $vendor_comission = ($price_int - $aff_commision) - $zenithstake_commision

            $total_vendor_sales = intval($user->total_vendpr_sales_cash);
            $total_vendor_sales_num = intval($user->totalvendor_sales);

            $user->total_vendor_sales_cash = $vendor_comission + $total_aff_sales;
            $user->total_vendor_sales = $total_vendor_sales_num + 1;

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
