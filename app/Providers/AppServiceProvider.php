<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Server PHP has no fileinfo extension; detect upload types from file content instead.
        if (!extension_loaded('fileinfo')) {
            \Symfony\Component\Mime\MimeTypes::getDefault()->registerGuesser(new \App\Support\ContentMimeTypeGuesser());
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // On a fresh database (before `php artisan migrate`) the settings table doesn't exist yet;
        // skip loading settings so artisan/migrations can still run.
        if ($this->app->runningInConsole() && !\Illuminate\Support\Facades\Schema::hasTable('generals')) {
            return;
        }
        if (!general()->exists) {
            return;
        }

        \Config::set("services.facebook.client_id", general()->fb_app_id);
        \Config::set("services.facebook.client_secret", general()->fb_app_secret);
        \Config::set("services.facebook.redirect", general()->fb_app_secret);

        \Config::set("services.google.client_id", general()->google_client_id);
        \Config::set("services.google.client_secret", general()->google_client_secret);
        \Config::set("services.google.redirect", general()->google_client_redirect_url);
        
        \Config::set("mail.mailers.smtp.transport", general()->mail_driver);
        \Config::set("mail.mailers.smtp.host", general()->mail_host);
        \Config::set("mail.mailers.smtp.port", general()->mail_port);
        \Config::set("mail.mailers.smtp.encryption", general()->mail_encryption);
        \Config::set("mail.mailers.smtp.username", general()->mail_username);
        \Config::set("mail.mailers.smtp.password", general()->mail_password);
    }
}
