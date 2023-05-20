<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\MyEmail;
use App\Mail\RecoverAccountMail;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class MembersController extends Controller
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

    public function test_email(){

        $logo = asset('https://zenithstake.syncight.com/storage/images/general/logo.png');

        Mail::to('ebubeemeka19@gmail.com')->send(new RecoverAccountMail("1234","Ebube", $logo));
    }

    public function test_email_view(){
        $logo = asset('https://zenithstake.syncight.com/storage/images/general/logo.png');
        $data = ['emailCode' => '123456', 'firstName'=>'Bob',"logo"=> $logo];
        return view('test_email', $data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function test(){



        return response()->json(['message'=>'its working!']);
    }

    public function store(Request $request)
    {
       

       

        $validated = $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'phone' => 'required|string',
               
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
                'is_payed'=> 'required|string'
              
            ],
          
             
        );


        $user = new Members();
        $user->firstName = ($validated["firstName"]);
        $user->lastName = ($validated["lastName"]);
        $user->is_payed = $validated["is_payed"];
      
        $user->phone = $validated["phone"];
        $user->email = strtolower($validated["email"]);

        $checkEmailValid = $this->checkEmailValid($user->email);

        //generate 4 digit email otp
        $otp = $random_number = rand(1000, 9999);


        $user->email_code =  $otp;
        $user->email_verified = false;
      
      
        $user->password = Hash::make($validated["password"]);

        //generate affiliate id
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = substr(str_shuffle($characters), 0, 6);
        $user->affiliate_id = $random_string;

        $checkEmailValid = $this->checkEmailValid($user->email);
        $checkEmailExists = $this->checkEmailExists($user->email);
        $checkPhoneExists = $this->checkPhoneExists($user->phone);

        if($checkEmailValid && !$checkEmailExists && !$checkPhoneExists ){

        $user->save();

        $lastInsertedId = $user->id;

        // Generate a new API token for the user...
        $token = $user->createToken('auth_token')->plainTextToken;

        $send_verification_email = $this->send_mail_verify_code($user->email,$user->email_code,$user->firstName );

      
            return response()->json(['message'=>'success','user_id'=>$lastInsertedId ],200);

   

       

        }
        else if(!$checkEmailValid){

            return response()->json(['message'=>'Please use a valid email'],405);


        }

        else if($checkEmailExists){

            return response()->json(['message'=>'That email is in use already, please try another'],405);


        }

        else if( $checkPhoneExists){

            return response()->json(['message'=>'That phone number is in use already, please try another'],405);


       

    }
}

    

    public function login(Request $request){

        try{
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Members::where('email', $request->email)
       // ->where('is_payed', "true")
        ->first();

        if (!$user ) {
             return response()->json(['message'=>'That email doesn\'t exist.'],405);
        }
        else if(!Hash::check($request->password, $user->password)){
            return response()->json(['message'=>'That password is wrong.'],405);

        }

        $token = $user->createToken('auth_token')->plainTextToken;

        if($user->email_verified==false){
            //  return response()->json(['message'=>'Your email is yet to be verified. Please verify your email.'],403);
  
            //if the email isnt verified yet, send an email to the user
             $this->send_mail_verify_code($user->email, $user->email_code, $user->firstName);
  
          }


          if($user->is_payed=="false" || $user->is_payed==null){
            // return response()->json(['message'=>'You haven\t completed your registration'],406);
 
         }
        return response()->json([
            'message' => 'Successfully logged in.',
            'user_details' => $user,
            'access_token' => $token
        ]);

       
       

      

      
       
       /* if($user->email_verified==1 && $user->is_payed=="true"){

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Successfully logged in.',
            'user_details' => $user,
            'access_token' => $token
        ]);
   //

}*/

    }catch(Exception $e){

        return response()->json(['message' => $e->getMessage()],500);
    }


    
    }

    //validate email address
public function checkEmailValid($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // email is valid
       return true;
      } else {
        // email is not valid
      return false;
      }
    }
      

        //Check if email is already in use by another user

    public function checkEmailExists($email)
    {
      
        $user = Members::where('email', $email)->first();
    
        if ($user) {
            return $user;
           // return response()->json(['exists' => true]);
        } else {
            return false;
           // return response()->json(['exists' => false]);
        }
    }
    

      
        
     //Check if phone is already in use by another user
    




public function checkPhoneExists($phone)
{
  
    $user = Members::where('phone', $phone)->first();

    if ($user) {
        return true;
       // return response()->json(['exists' => true]);
    } else {
        return false;
       // return response()->json(['exists' => false]);
    }
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function show(Members $members)
    {
        //
        $members = Members::all();
        return response()->json($members);
    }

    public function view_user(Request $request){

      
            $request->validate([
                'id' => 'required',
                
            ]);
    
            $user = Members::where('id', $request->id)->first();
    
            if (!$user ) {
                 return response()->json(['message'=>'That user doesn\'t exist.'],405);
            }else{
                return response()->json(['user_data'=>$user],200);
            }
          

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function edit(Members $members)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Members $members)
    {
       
        $request->validate([
            'id' => 'required',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'phone' => 'required|string',
            'bankAccountName' => 'string',
            'bankAccountNumber' => 'string',
            'bank' => 'string',
            
        ]);
        $user = Members::where('id', $request->id)->first();

        if (!$user ) {
             return response()->json(['message'=>'That user doesn\'t exist.'],405);
        }else{


            //Set up curl to validate user account details and create payment code

            $url = "https://api.paystack.co/transferrecipient";

            //open connection
          

            $fields = [
                'type' => "nuban",
                'name' => $request->firstName ." ". $request->lastName,
                'account_number' => $request->bankAccountNumber,
                'bank_code' => $request->bank,
                'currency' => "NGN"
              ];
            
              $fields_string = http_build_query($fields);


              //run curl

              //open connection
                $ch = curl_init();
                
                //set the url, number of POST vars, POST data
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_POST, true);
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Authorization: Bearer sk_live_9e99c504399b16cf066e5d5a3eb0edfeb2f7de06",
                    "Cache-Control: no-cache",
                ));
                
                //So that curl_exec returns the contents of the cURL; rather than echoing it
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
                
                //execute post
                $result = curl_exec($ch);

                $api_data = json_decode($result, true);
               // echo $result;

               if($api_data->status == true){

                $user->firstName = $request->firstName;
                $user->lastName = $request->lastName;
                $user->phone = $request->phone;
                $user->bank_account_name = $request->bankAccountName;
                $user->bank_account_number = $request->bankAccountNumber;
                $user->bank = $request->bank;
                $user->payment_reference_paystack = $api_data->data->recipient_code;
                $user->save();

               }

               else{


                return response()->json(['message'=>'Sorry! We could not validate your bank details. Please ensure they are correct.'],405);

               }
               
           
        }
      
 

       
    }

    public function send_mail_code(Request $request){

        $request->validate([
            'email' => 'required|string',

        ]);

        $user =  $this->checkEmailExists( $request->email);

        if($user){

             //generate 4 digit email otp
             $emailCode = $random_number = rand(1000, 9999);

            $user->email_code = $emailCode ;
            $firstName = $user->firstName;
            $user->save();

            if(Mail::to($request->email)->send(new RecoverAccountMail(  $emailCode,$firstName  ))){
                return response()->json(['message'=>'We\'ve sent you an email to help you recover your password'],200);

            }
        }
        else{

            return response()->json(['message'=>'That email doesn\'t exist in our records'],405);

        }


    }

    public function send_mail_verify_code($email, $emailCode, $firstName){

            
            if(Mail::to($email)->send(new ConfirmEmail( $emailCode,$firstName))){

                return true;

            }
      
     


    }

    public function verify_email_with_code(Request $request){


        $request->validate([
            'code' => 'required|string',
            'email' => 'required|string',

        ]);

        $user_code_exists = Members::where('email_code', $request->code)
                             ->where('email', $request->email)
                              ->first();

        if($user_code_exists){

             //generate 4 digit email otp

             $user_code_exists->email_verified = true;

            if( $user_code_exists->save()){
                return response()->json(['message'=>'The email  was successfully verified'],200);

            }

            
          
        }
        else{

            return response()->json(['message'=>'Sorry! Could not verify that code. '.$request->email." ".$request->code],405);

        }

    }

    public function verify_code(Request $request){


        $request->validate([
            'code' => 'required|string',
            'email' => 'required|string',

        ]);

        $user_code_exists = Members::where('email_code', $request->code)
                             ->where('email', $request->email)
                              ->first();

        if($user_code_exists){

            $user_code_exists->email_verified = true;


            if( $user_code_exists->save()){
                return response()->json(['message'=>'The email  was successfully verified'],200);

            }
          
        }
        else{

            return response()->json(['message'=>'Sorry! Could not verify that code.'],405);

        }

    }

    public function change_password(Request $request){


        $request->validate([
            'password' => 'required|string',
            'email' => 'required|string',

        ]);

        $user = Members::where('email', $request->email)
     
         ->first();

        if($user){



            $user->password = Hash::make($request->password);
           
           if( $user->save()){
               //generate 4 digit email otp

        return response()->json(['message'=>'Your password has been successfully changed! You can login now.'],200);

           }
           else{

            return response()->json(['message'=>'Could not complete operation'],405);
    
            }


     

        }
        else{

        return response()->json(['message'=>'Sorry! Could not complete operation.'],405);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function destroy(Members $members)
    {
        //
    }
}
