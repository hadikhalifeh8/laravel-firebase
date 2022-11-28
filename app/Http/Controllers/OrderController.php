<?php

namespace App\Http\Controllers;

use App\Mail\ordermail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function createorder(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',      
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $stuRef = app('firebase.firestore')->database()->collection('order')->newDocument();
        $stuRef->set([
                      'name' => $request->name,
                    ]);
                    Mail::to("h7467489@gmail.com")->send(new ordermail($stuRef));
         
     
          return response()->json(
            [   
                'status' => 'success',   
              
            ]);
 
  

       

    }
}
