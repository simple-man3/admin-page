<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::allows('show_admin_panel',function ($user)
        {
            if($user->name=="simple")
                return true;
            else
                return false;
//            foreach ($user->roles as $all)
//            {
//                if($all->super_user==true)
//                    return true;
//            }
//            return false;
        });
    }
}
