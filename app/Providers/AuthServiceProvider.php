<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //


        //👉 - https://demos.pixinvent.com/vuexy-vuejs-admin-template/documentation/guide/laravel-integration/laravel-passport-integration.html#deploying-passport
        // Passport::routes();
        // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
    }
}
