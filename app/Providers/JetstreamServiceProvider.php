<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\IpUtils;
use Illuminate\Validation\ValidationException;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Fortify::authenticateUsing(function (Request $request) {
            // Validate reCAPTCHA first
            $recaptcha_response = $request->input('g-recaptcha-response');

            if (is_null($recaptcha_response)) {
                throw ValidationException::withMessages(['g-recaptcha-response' => 'Please complete the reCAPTCHA to proceed']);
            }

            $url = "https://www.google.com/recaptcha/api/siteverify";

            $body = [
                'secret' => config('services.recaptcha.secret'),
                'response' => $recaptcha_response,
                'remoteip' => IpUtils::anonymize($request->ip())
            ];

            $response = Http::asForm()->post($url, $body);

            if (! $response->successful()) {
                throw ValidationException::withMessages(['g-recaptcha-response' => 'reCAPTCHA validation failed. Please try again.']);
            }
            
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
