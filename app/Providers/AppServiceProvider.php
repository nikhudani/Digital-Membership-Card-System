<?php

namespace App\Providers;

use App\Models\Dashboard\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use TE;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if (app()->isLocal()) {
        //     URL::forceScheme('https');
        // }
        Config::set([
            /** Branding Configuration */
            'app.name' => TE::system('title', env('APP_NAME')),
            /** Email Configuration */
            'mail.mailers.smtp.transport' => TE::system('mail_mailer', env('MAIL_MAILER')),
            'mail.mailers.smtp.host' => TE::system('mail_host', env('MAIL_HOST')),
            'mail.mailers.smtp.port' => TE::system('mail_port', env('MAIL_PORT')),
            'mail.mailers.smtp.username' => TE::system('mail_username', env('MAIL_USERNAME')),
            'mail.mailers.smtp.password' => TE::system('mail_password', env('MAIL_PASSWORD')),
            'mail.mailers.smtp.encryption' => TE::system('mail_encryption', env('MAIL_ENCRYPTION')),
            'mail.from.address' => TE::system('mail_from_address', env('MAIL_FROM_ADDRESS')),
            'mail.from.name' => TE::system('title', env('APP_NAME'))
        ]);
    }
}
