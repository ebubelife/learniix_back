<?php

namespace App\Http\Controllers;

use App\Models\Vendors;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorsController extends Controller
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

           

        // Validate the request inputs
    $validator = Validator::make($request->all(), [
        'businessName' => 'required|string',
        'bio' => 'required|string',
        'id' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10024', // Adjust the max file size as needed
    ]);

    // Check if the validation fails
    if ($validator->fails()) {
        return response()->json(['message' => 'Validation error'.$validator->errors(), 'errors' => $validator->errors()], 422);
    }
    
     // Retrieve the validated data
     $validated = $validator->validated();
       
        $user =Members::find(intval($validated['id']));

            
        if ($user) {
        $user->is_vendor = true;
        $user->save();
        
        $vendor = new Vendors();
        $vendor ->businessName = $validated['businessName'];
        $vendor ->bio = $validated['bio'];
        $vendor ->vendor_id = $user->id;

        // Retrieve the uploaded file from the request
        $image = $request->file('image');

        // Generate a unique filename for the uploaded file
        $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();

        // Upload the file to the storage disk (public disk by default)
        $image->storeAs('public/images/vendor_images', $filename);

        // Return a success response with the URL of the uploaded file
       

                if( $image->storeAs('public/images/vendor_images', $filename)){
                    $vendor ->image = $filename;
                    $vendor ->save();
                    return response()->json(['message'=>'success'],200);
                }

                else{
                    return response()->json(['message'=>'Sorry, your image could not be uploaded!'],405);
                }
    
      
        // return response()->json(['exists' => true]);
        } else {
            return response()->json(['message'=>'That user does\'t exist please try again! '.$e, 'error'=>$e],405);
    
    
        }
    
       
    
             
        }
        catch(\Exception $e){
            return response()->json(['message'=>'An error occured, please try again', 'error'=>$e],405);
    
    
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendors  $vendors
     * @return \Illuminate\Http\Response
     */
    public function show(Vendors $vendors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendors  $vendors
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendors $vendors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendors  $vendors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendors $vendors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendors  $vendors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendors $vendors)
    {
        //
    }
}
