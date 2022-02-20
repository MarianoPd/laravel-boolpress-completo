<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contact;
use App\Mail\NewContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
       
        $validator = Validator::make($data,[
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required|',
        ],
        [
            'name.required' => 'The name is required',
            'name.max' => 'The name is too long',
            'email.required' => 'The email is emailired',
            'email.max' => 'The email is too long',
            'message.required' => 'The message is required',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $new_contact = new Contact();
        $new_contact->fill($data);
        $new_contact->save();


        Mail::to('info@boolpress.com')->send(new NewContactMail($new_contact));

        return response()->json(['success' => true]);
    }
}
