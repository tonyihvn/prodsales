<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\tasks;
use App\Models\User;
use App\Models\settings;
use App\Models\businessgroups;

use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using view composer to set following variables globally


        view()->composer('*',function($view) {

            if (Auth::check())
            {
                $view->with('login_user', Auth::user());
                $view->with('mytasks', tasks::where('assigned_to',Auth::user()->id)->where('status','Not Completed')->get());
                $view->with('customers', User::select('id','name','status')->where('setting_id',Auth::user()->id)->get());
                $view->with('userbusinesses',settings::select('id','business_name','businessgroup_id')->where('user_id',Auth::user()->id)->orWhere('id',Auth()->user()->setting_id)->get());

                $view->with('settings', settings::where('id',Auth::user()->setting_id)->first());

            }else{
                $view->with('settings', settings::first());
            }

            $view->with('businessgroups',businessgroups::select('id','businessgroup_name')->get());

            // if you need to access in controller and views:
            // Config::set('something', $something);
        });
    }
}
