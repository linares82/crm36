<?php

namespace App\Providers;

use App\Providers\MailTransportManager;
use Illuminate\Mail\MailServiceProvider;

class CustomMailServiceProvider extends MailServiceProvider
{
    protected function registerSwiftTransport()
    {
        /*$this->app['swift.transport'] = $this->app->share(function ($app) {
            return new MailTransportManager($app);
        });*/
        
        $this->app->singleton('swift.transport', function ($app) {
             return new MailTransportManager($app);
        });
        
    }
}