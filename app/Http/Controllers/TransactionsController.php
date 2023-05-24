<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\Members;
use Illuminate\Http\Request;
use App\Mail\ConfirmEmail;
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

        try{

            //get affiliate

            $unpaid_users = Members::where("is_vendor", false)
                            ->where("payment_reference_paystack","!=",null)
                            ->whereRaw("CAST(unpaid_balance AS UNSIGNED) > 0")
                            ->get();

            return response()->json(['message'=>$unpaid_users],405);


    
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
