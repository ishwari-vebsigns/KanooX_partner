<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationWebController extends Controller
{

    public function index()
    {
        return view('admin.notifications.send');
    }

    public function send(Request $request)
    {

        $request->validate([
            'title'=>'required',
            'message'=>'required'
        ]);

        $response = Http::post('https://loansarovar.com/api/send-notification',[
            'title'=>$request->title,
            'message'=>$request->message
        ]);

        if($response->successful()){
            return redirect()->back()->with('success','Notification Sent Successfully');
        }

        return redirect()->back()->with('error','Notification failed');

    }

}