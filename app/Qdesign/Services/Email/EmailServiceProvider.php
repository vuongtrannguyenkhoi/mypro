<?php namespace Qdesign\Services\Email;

use Illuminate\Support\ServiceProvider;


class EmailServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $app->bind(
            'Qdesign\Services\Email\EmailInterface',
            'Qdesign\Services\Email\Swiftmailer\Email'
        );
    }

}