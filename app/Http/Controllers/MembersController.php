<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        //
        $name = $request->input('firstName');

        try{

            $validated = $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'phone' => 'required|string',
               
                'email' => 'required|string|email|unique:members,email|max:255',
                'password' => 'required|string|min:8',
              
            ],
            [
                "email.required"=>"Please enter a valid email address",
                "phone.required"=>"Please enter a valid phone number",
            ]
             
        );

        $user = new Members();
        $user->firstName = $validated['firstName'];
        $user->lastName = $validated['lastName'];
      
        $user->phone = $validated['phone'];
        $user->email = $validated['email'];

        $checkEmailValid = $this->checkEmailValid($user->email);

        //generate 4 digit email otp
        $otp = $random_number = rand(1000, 9999);


        $user->email_code =  $otp;
        $user->email_verified = false;
      
      
        $user->password = Hash::make($validated['password']);

        //generate affiliate id
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $random_string = substr(str_shuffle($characters), 0, 6);
        $user->affiliate_id = $random_string;

        $user->save();

        // Generate a new API token for the user...
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message'=>'success'],200);

          
        }
        catch(\Exception $e){
            return response()->json(['message'=>'failed', 'error'=>$e,'ff'=> $name],400);


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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function show(Members $members)
    {
        //
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
        //
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
