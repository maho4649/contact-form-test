<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register custom view responses if necessary
    }

    public function boot(): void
    {
        // ログイン試行回数制限を設定
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(10)->by($request->email . $request->ip());
        });

        Fortify::authenticateUsing(function (Request $request) {
    $user = \App\Models\User::where('email', $request->email)->first();

    dd($user, $request->password);

    if ($user && Hash::check($request->password, $user->password)) {
        return $user;
    }

    return null;
});


        // Fortifyのインターフェースにクラスをバインド
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);

        // Fortifyにアクションを登録
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // ログインページのビューにエラーメッセージを渡す
        Fortify::loginView(function () {
            return view('auth.login');
        });
    }
}
