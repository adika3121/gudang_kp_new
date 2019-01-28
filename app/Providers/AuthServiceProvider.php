<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('isAdmin', function($user){
            return $user->role == 'admin';
        });

        $gate->define('isMarketing', function($user){
            return $user->role == 'marketing';
        });

        $gate->define('isPengiriman', function($user){
            return $user->role == 'pengiriman';
        });

        $gate->define('isGudang', function($user){
            return $user->role == 'gudang';
        });
    }
}
