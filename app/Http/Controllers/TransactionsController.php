<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Members;
use Illuminate\Http\Request;
use App\Mail\AffiliatePayment;
use Illuminate\Support\Facades\Mail;

class TransactionsController extends Controller
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

    public function pay_affiliates(Request $request){

        $all_tx_result = array();

        try{

              //get affiliate

              $unpaid_users = Members::where("is_vendor", false)
              ->where("payment_reference_paystack","!=",null)
              ->where("email","ebubeemeka19@gmail.com")
            //  ->whereRaw("CAST(unpaid_balance AS UNSIGNED) > 0")
              ->get();




            foreach( $unpaid_users as  $unpaid_user){

          
            $url = "https://api.flutterwave.com/v3/transfers";

            $fields = array(
              "account_bank" => "033",
              "amount" => 100,
             
              "account_number"=> "2127100962",
              "narration" => "ZENITHSTAKE ENTERPRISE",
              "currency"=> "NGN",
            );

          
          
         /*   $fields_string = http_build_query($fields);
          
            //open connection
            $ch = curl_init();
            
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, true);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              "Authorization: Bearer TOKEN HERE",
              "Cache-Control: no-cache",
            ));
            
            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);*/

            $jsonData = json_encode($fields);

            $curl = curl_init();
            
         
                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://api.flutterwave.com/v3/transfers',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $jsonData,
                    CURLOPT_HTTPHEADER => [
                        'Authorization: Bearer FLWSECK-04562a5b70635c4c57442a53df1b5b44-18847d9721evt-X',
                        'Content-Type: application/json',
                    ],
                ]);
            
            //execute post
            $result = curl_exec($curl);
           // echo $result;

           if($result["status"]=="success"){

            Mail::to($unpaid_user->email)->send(new AffiliatePayment( $unpaid_user->unpaid_balance,$unpaid_user->firstName." ".$unpaid_user->lastName));
            $single_tx_result = array("user"=>$unpaid_user->id,"result"=>$result); 

            array_push($all_tx_result, $single_tx_result);

           }



        

        }

           return response()->json(['message'=> "done","tx_result"=>$all_tx_result],200);
       
    }
    catch(\Exception $e){
        return response()->json(['message'=>'An error occured, please try again', 'error'=>$e],405);







    }
}


    public function store(Request $request)
    {
        //


        try{

           

            $validated = $request->validate([
                'tx_ref' => 'required|string',
                'tx_type' => 'required|string',
                'user_id'=>  'required|string',
                'amount'=>  'required|string',
                'status'=>  'required|string',
               
               
            ],
           
        );
    
       
   
        
        $tx= new Transactions();
        $tx ->tx_ref = $validated['tx_ref'];
        $tx ->tx_type = $validated['tx_type'];
        $tx ->user_id =  $validated['user_id'];

       if($tx->save()){

        $user = Members::where('id', $request->user_id)->first();

        $user->is_payed = "true";

        if($user->save()){

            //if transaction is successful and tx type is VENDOR_REG send email to vendor to verify email

            if($validated['tx_type'] == 'VENDOR_REG' || $validated['tx_type'] == 'AFFILIATE_REG' ){
                  
            if(Mail::to($user->email)->send(new ConfirmEmail( $user->email_code,$user->firstName))){

                return true;

            }

            }

            return response()->json(['message'=>'Transaction successfully saved'],200);

        }
        else{
            return response()->json(['message'=>'An error occured, please contact support', 'error'=>$e],405);
    
        }

       

       }
      
    

       else
       return response()->json(['message'=>'An error occured, please contact support', 'error'=>$e],405);
    

       

    
             
        }
        catch(\Exception $e){
            return response()->json(['message'=>'An error occured, please try again', 'error'=>$e],405);
    
    
        }
    


    }


    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
        $transactions = Transactions::all();
        return response()->json($transactions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
