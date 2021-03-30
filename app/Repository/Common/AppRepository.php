<?php

namespace App\Repository\Common;

use App\Repository\Users\UserRepository;
use mysqli;
use Exception;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\DB;


abstract class AppRepository {

    public static function send_mail($to_emails, $subject, $template, $template_data = [], $attachment = FALSE) {
        Mail::send($template, $template_data, function($message) use ($to_emails, $subject, $attachment) {
            $message->to($to_emails)
                    ->subject($subject)
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            if ($attachment) {
                $message->attach($attachment);
            }
        });
        return true;
    }
}
