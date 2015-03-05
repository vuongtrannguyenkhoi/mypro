<?php namespace Qdesign\Services\ContactEmail;

use Illuminate\Support\ServiceProvider;


class ContactEmailServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $app->bind(
            'Qdesign\Services\ContactEmail\ContactEmailInterface',
            'Qdesign\Services\ContactEmail\Swiftmailer\ContactEmail'
        );
    }

}