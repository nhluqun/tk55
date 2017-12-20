<?php

namespace App\Providers;
use Carbon\Carbon;
use Laravel\Passport\Passport;
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
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
Passport::routes();
        //
        // token的有效期时长：2小时
Passport::tokensExpireIn(Carbon::now()->addHour(2));

// refresh token的有效期时长：7天
Passport::refreshTokensExpireIn(Carbon::now()->addDay(7));
    }
}
