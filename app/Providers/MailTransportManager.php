<?php

namespace App\Providers;

use Illuminate\Mail\TransportManager;
use Auth;

class MailTransportManager extends TransportManager
{
    public function __construct(IlluminateFoundationApplication $app)
    {
        
        $settings [mailHost]= Auth::user()->mail_host ; //get your settings from somewhere
        $settings [mailPort]= Auth::user()->mail_port;
        $settings [mailFromAddres]= Auth::user()->email;
        $settings [mailFromName]= Auth::user()->name;
        $settings [mailUserName]= Auth::user()->email;
        $settings [mailPassword]= Auth::user()->mail_password;
        
            $this->setDefaultDriver('smtp');
            $this->app['config']['mail'] = [
                'driver' => 'smtp',
                'host' => $settings['mailHost'] ?? 'smtp.yandex.net',
                'port' => $settings['mailPort'] ?? 465,
                'from' => [
                    'address' => $settings['mailFromAddress'] ?? '',
                    'name' => $settings['mailFromName'] ?? '',
                ],
                'encryption' => 'tls',
                'username' => $settings['mailUsername'] ?? '-',
                'password' => $settings['mailPassword'] ?? '-',
                'sendmail' => $settings['mailSendmailPath'] ?? '/usr/sbin/sendmail -bs',
                'pretend' => false,
            ];

            config()->set('mail', $this->app['config']['mail']);
            //i'm not sure if its necessary.
    }
}