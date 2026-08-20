<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Auth;

class ContactController extends Controller
{
    public function getContact(){
        return view('contact');
    }
    public function postContact(Request $request){
        // dd($request->all());
        if(Auth::user()==""){
            return redirect('/login');
        }
         $name = $request->name;
         $email = $request->email;
         $phone_number = $request->phone_number;
         $subject = $request->subject;
         $message = $request->message;
         
         $contact = new Contact();
         $contact->name = $name;
         $contact->email = $email;
         $contact->phone_no = $phone_number;
         $contact->subject = $subject;
         $contact->comment = $message;
         $contact->save();

         return redirect('/');
         
    }
}
