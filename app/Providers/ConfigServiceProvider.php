<?php

namespace App\Providers;

use Config;
use DB;
use Illuminate\Support\ServiceProvider;
use Veritrans_Config;

class ConfigServiceProvider extends ServiceProvider {

    /**
     * Overwrite any vendor / package configuration.
     *
     * This service provider is intended to provide a convenient location for you
     * to overwrite any "vendor" or package configuration that you may want to
     * modify before the application handles the incoming request / command.
     *
     * @return void
     */
    public function register() {
        
        Veritrans_Config::$serverKey = env('VERITRANS_KEY', '');
// Use sandbox account
        Veritrans_Config::$isProduction = env('VERITRANS_PRO', false);
        $mail = DB::table('option_mail')->lists('mail_value', 'mail_key');
        $email = DB::table('option_general')->lists('gen_store_val', 'gen_store_name');
        if ($mail && $email) {
            $config = [
                'driver' => $mail['mail_driver'],
                'host' => $mail['mail_host'],
                'port' => $mail['mail_port'],
                'encryption' => $mail['mail_encryption'],
                'username' => $mail['mail_username'],
                'password' => $mail['mail_password'],
                "from" => [
                    "address" => $email['store_email'],
                    "name" => "Owner Email"
                ],
                "sendmail" => "/usr/sbin/sendmail -bs",
                "pretend" => false,
            ];
            Config::set('mail', $config);
        }
    }

}
