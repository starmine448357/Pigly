<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\ResetUserPassword;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\RegisterResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // 登録処理は CreateNewUser に一任
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    public function boot(): void
    {
        // ビューのカスタマイズ
        Fortify::loginView(fn() => view('auth.login'));
        Fortify::registerView(fn() => view('auth.register'));
        Fortify::requestPasswordResetLinkView(fn() => view('auth.forgot-password'));
        Fortify::resetPasswordView(fn($request) => view('auth.reset-password', ['request' => $request]));

        // 各種アクションの登録
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        // 登録後リダイレクト
        $this->app->singleton(RegisterResponse::class, fn() => new class implements RegisterResponse {
            public function toResponse($request) {
                return redirect()->route('weight_logs.index');
            }
        });

        // レートリミット
        RateLimiter::for('login', fn(Request $request) => 
            Limit::perMinute(5)
                ->by(Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip()))
        );
        RateLimiter::for('two-factor', fn(Request $request) => 
            Limit::perMinute(5)->by($request->session()->get('login.id'))
        );
    }
}
