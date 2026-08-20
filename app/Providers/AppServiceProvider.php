<?php

namespace App\Providers;
use Auth;
use View;
use App\Models\User;
Use Hash;
use App\Models\Userloan;
use App\Models\Loan;
use App\Models\Service;
use App\Models\Notification;
use App\Models\Permission;
use App\Models\RolePermission;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
    {

        $getuser=auth()->user();

        View::share('base_url', config('app.url'));
        $mservices = Service::where('is_main_service',1)->get();
        $mpermissions=Permission::where('permission_id',0)->pluck('permission_name');
        $mnotifications = Notification::where('status_id',1)->Orderby('created_at', 'desc')->get();
        // dd($mnotifications);

        
        if (Auth::user()) {
            $user_id=Auth::user()->id;
            $role_id=Auth::user()->role_id;
            $role_permission_ids=RolePermission::where('role_id',$role_id)->pluck('permission_id');
            // $user_permission_ids=UserPermission::where('user_id',$user_id)->pluck('permission_id');
            $mpermissions=Permission::orWhereIn('permission_id',$role_permission_ids)->pluck('permission_name');
            $agentqrcode = User::where('id',Auth::user()->id)->with('agent_qr')->first();
            // dd($agentqrcode);
            View::share('agentqrcode', $agentqrcode);

          }
        $loans = Loan::all();
        // dd($services);
        View::share('mservices', $mservices);
        View::share('mnotifications', $mnotifications);
        View::share('my_permissions', $mpermissions);


        });
    }
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    
}
