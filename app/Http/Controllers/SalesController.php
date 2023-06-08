<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Members;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Mail\AffiliateEmail;
use App\Mail\VendorEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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

    public function testemail(){

        if(Mail::to("kongonut@gmail.com")->send(new AffiliateEmail( "kongonut@gmail.com", "Affiliate", "10000","5000" ))){

            return true;

        }

        if(Mail::to("kongonut@gmail.com")->send(new VendorEmail("kongonut@gmail.com","Vendor", "10000","4000"))){

            return true;

        }
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

        DB::beginTransaction();


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
           

            //calculate total affiliate commission and save


            $affiliate = Members::where('affiliate_id', $validated["affiliate_id"])->first();

            $commission_int = intval($validated["commission"]);
            $price_int = intval($validated["product_price"]);
            $total_aff_sales = intval($affiliate->total_aff_sales_cash);
            $total_aff_sales_num = intval($affiliate->total_aff_sales);

            $affiliate->total_aff_sales_cash = strval((($commission_int/100) * $price_int)  + $total_aff_sales);
            $affiliate->total_aff_sales = strval($total_aff_sales_num + 1);

            $unpaid_balance_affiliate = intval($affiliate->unpaid_balance);

            $affiliate->unpaid_balance = strval($unpaid_balance_affiliate + (($commission_int/100) * $price_int));


           


            //calculate vendor commision an save


            $user = Members::where('id', $validated["vendor_id"])->first();

            $commission_int = intval($validated["commission"]);
            $price_int = intval($validated["product_price"]);

            $aff_commision = (($commission_int/100) * $price_int);
            $zenithstake_commision = ((10/100) * $price_int);

            $vendor_comission = ($price_int - $aff_commision) - $zenithstake_commision;

            $total_vendor_sales = intval($user->total_vendor_sales_cash);
            $total_vendor_sales_num = intval($user->total_vendor_sales);

            $unpaid_balance_vendor = intval($user->unpaid_balance_vendor);

            $user->total_vendor_sales_cash = strval($vendor_comission + $total_vendor_sales);
            $user->total_vendor_sales = strval($total_vendor_sales_num + 1);

            $user->unpaid_balance_vendor = strval($unpaid_balance_vendor + ($vendor_comission ));

            if( $sale->save()){

            //Save affiliate commission

          if( $affiliate->save()){


          
                //Save vendor commission
           if( $user->save()){

                $getAffiliate = Members::where('affiliate_id', $validated["affiliate_id"])->first();
                $getVendor = Members::where('id', $validated["vendor_id"])->first();

                //send email to affiliate

                if(Mail::to($getAffiliate )->send(new AffiliateEmail( $getAffiliate->email, $getAffiliate->firstName, $validated["product_price"],strval($aff_commision ), $validated["customer_email"]))){

                

                    //send email to vendor

                            if(Mail::to($getVendor)->send(new VendorEmail( $getVendor->email,$getVendor->firstName,$validated["product_price"],strval($vendor_comission)))){

                                return response()->json(['message'=>'Successful' ],200);

                            }
                            else{

                                return response()->json(['message'=>'Successful. Could not send email notification - 1'],200);
                            }

            }else{
                return response()->json(['message'=>'Successful!.Could not send email notification - 2'],200);
            }

           

           }else{
            return response()->json(['message'=>'Could not verify the vendor. Please contact Zenithstake admin'],405);
           }
        }
        else{
            return response()->json(['message'=>'Could not verify the affiliate. Please contact the ZenithStake admin'],405);
        }

    }else{
        return response()->json(['message'=>'Could not save this transaction. Please contact the ZenithStake admin'],405);

    }

        DB::commit();
    }
    catch(\Exception $e){
        DB::rollBack();
        return response()->json(['message'=>'An error occured, please try again', 'error'=>$e->getMessage()],405);


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
        $sales = Sales::join('products', 'sales.product_id', '=', 'products.id')
        ->join('members', 'sales.affiliate_id', '=', 'members.affiliate_id')
        ->select('sales.*', 'products.productName as product_name', 'products.productPrice', 'members.firstName as affiliate_first_name','members.lastName as affiliate_last_name')
        ->orderByDesc('created_at')
        ->get();

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

        if($validated["selected_product"] == 'all'){
            $sales_by_user = Sales::where('affiliate_id', $validated["affiliate_id"])
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



    public function show_vendor_sales_from_date(Request $request){

      

        /*  $sale = new Sales();
  
              
          $sale->affiliate_id =  $validated["affiliate_id"];
          $sale->from_date =  $validated["from_date"];
          $sale->to_date =  $validated["to_date"];*/
  
  
          try{
  
              $validated = $request->validate([
                  'vendor_id' => 'required|string',
                  'from_date' => 'required|string',
                  'to_date' => 'required|string',
                  'selected_product' => 'required|string',
                 
                 
              ]);
  
          $from = $validated["from_date"];
          $to = $validated["to_date"];
  
          if($validated["selected_product"] == 'all'){
              $sales_by_user = Sales::where('vendor_id', $validated["vendor_id"])
              ->where('created_at', '>=', Carbon::parse($from))
              ->where('created_at', '<=', Carbon::parse($to))
              ->get();
  
          }else{
  
            $sales_by_user = Sales::where('vendor_id', $validated["vendor_id"])
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


      public function show_vendor_sales_from_date_as_affiliates(Request $request){

        //This method selects affiliates sales between dates and returns them according to count of sales 

      

        /*  $sale = new Sales();
  
              
          $sale->affiliate_id =  $validated["affiliate_id"];
          $sale->from_date =  $validated["from_date"];
          $sale->to_date =  $validated["to_date"];*/
  
  
          try{
  
              $validated = $request->validate([
                  'vendor_id' => 'required|string',
                  'from_date' => 'required|string',
                  'to_date' => 'required|string',
                  'selected_product' => 'required|string',
                 
                 
              ]);
  
          $from = $validated["from_date"];
          $to = $validated["to_date"];
  
          if($validated["selected_product"] == 'all'){
              $sales_by_user = Sales::where('vendor_id', $validated["vendor_id"])
              ->selectRaw('sales.affiliate_id, COUNT(*) as count, members.*')
              ->join('members', 'members.affiliate_id', '=', 'sales.affiliate_id')
              ->groupBy('sales.affiliate_id', 'members.id', 'members.affiliate_id')
             
              ->where('sales.created_at', '>=', Carbon::parse($from))
              ->where('sales.created_at', '<=', Carbon::parse($to))
              ->limit(200)
              ->get();
  
          }else{
  
            $sales_by_user = Sales::where('vendor_id', $validated["vendor_id"])
            ->selectRaw('sales.affiliate_id, COUNT(*) as count, members.*')
            ->join('members', 'members.affiliate_id', '=', 'sales.affiliate_id')
            ->groupBy('sales.affiliate_id', 'members.id', 'members.affiliate_id')
           
            ->where('sales.created_at', '>=', Carbon::parse($from))
            ->where('sales.created_at', '<=', Carbon::parse($to))
            ->where('sales.product_id', $validated["selected_product"])
            ->limit(200)
             
              ->get();
  
          }
        
  
  
                          return response()->json(["message"=>$sales_by_user, "to"=>$to, "from"=>$from]);
  
          }
          catch(\Exception $e){
              return response()->json(['message'=>'An error occured, please try again', 'error'=>$e->getMessage()],405);
      
      
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
