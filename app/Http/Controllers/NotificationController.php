<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notification;
use App\Models\Notificationread;
use App\Exports\exportNotification;
use Maatwebsite\Excel\Facades\Excel;
use Config;
use DataTables;
class NotificationController extends Controller
{
    public function sendnotificationdetails(Request $request){
        // dd($request->id1, $request->notifid);
        $user_id = $request->id1;
        $notifid =  $request->notifid;
        $check_noti = Notificationread::where('noti_id',$notifid)->where('user_id', $user_id)->first();
        if($check_noti==null){
            $readnoti = new Notificationread();
            $readnoti->noti_id = $notifid;
            $readnoti->user_id = $user_id;
            $readnoti->save();
        }

    }
    public function getAllNotificationcontent(){
        // NOTIFICATIONS
        if(!$this->checkPermission(Config::get('permissions.NOTIFICATIONS'))){
			return view('admin.unauthorized');
		}
        return view('admin.notifications');
    }
    public function getAddNotification(){
        if(!$this->checkPermission(Config::get('permissions.NOTIFICATION_ADD'))){
			return view('admin.unauthorized');
		}
        return view('notification.add');
    }
    public function postAddNotification(Request $request){
        // dd($request->all());
        $notification_name = $request->notification_name;
        $description = $request->description;
        $type = $request->type;

        $notification = new Notification();
        $notification->title = $notification_name;
        if($request->image!=""){
            $image = $request->image;
            $path = $image->store('Notification-images');
            $notification->image=$path;
        }
        $notification->description =$description;
        $notification->status_id = 1;
        $notification->type = $type;
        $notification->save();
        $request->session()->put('success',"Notification Added Successfully!!");
        return redirect('admin/notification/all');
    }
    public function getEditNotification(Request $request){
        if(!$this->checkPermission(Config::get('permissions.NOTIFICATION_DETAILS'))){
			return view('admin.unauthorized');
		}
        $id = $request->id;
        $notification = Notification::where('notification_id', $id)->first();
        return view('notification.detail')->with('notification', $notification);
    }
    public function postEditNotification(Request $request){
        // dd($request->all());
       
        $id = $request->id;
        $notification = Notification::where('notification_id', $id)->first();
        $notification_name = $request->notification_name;
        $description = $request->description;
        $type = $request->type;
        if(isset($request['save'])){
        $notification->title = $notification_name;
        if($request->image!=""){
            $image = $request->image;
            $path = $image->store('Notification-images');
            $notification->image=$path;
        }
        $notification->type = $type;
        $notification->description =$description;
        $notification->save();
        $request->session()->put('success',"Notification Updated Successfully!!");
    }
    if(isset($request['active'])){
        $notification->status_id = 1;
        $notification->save();
        $request->session()->put('success',"Notification Activated Successfully!!");
    }
    if(isset($request['inactive'])){
        $notification->status_id = 0;
        $notification->save();
        $request->session()->put('success',"Notification In-activated Successfully!!");
    }
        return redirect('admin/notification/all');
    }
    public function getAllNotification(){
        if(!$this->checkPermission(Config::get('permissions.NOTIFICATION_ALL'))){
			return view('admin.unauthorized');
		}
        $notifications = Notification::all();
        return view('notification.all')->with('notifications',$notifications);
    }
    public function getAllNotificationdata(){
        if(!$this->checkPermission(Config::get('permissions.NOTIFICATION_ALL'))){
			return view('admin.unauthorized');
		}
        $notifications = Notification::all();
        return DataTables::of($notifications)->make(true);
    }
    public function exportNotification(Request $request){
        return Excel::download(new ExportNotification, 'Notifications.xlsx'); 

    }
}
