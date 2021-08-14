<?php

namespace App\Util\MailSender\BLL;

use Illuminate\Mail\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendMailBLL implements SendMailBLLInterface
{

    public function sendMail(
        $to,
        $data,
        $template,
        $subject,
        $from = null,
        $name_sender = null,
        $name_user = null,
        $files = null,
        $cc = null
    ) {
        // TODO: change this to pull default email and name from .env
        $from = ($from) ? $from : env('MAIL_SENDER','no-reply@starter.test');
        $name_sender = ($name_sender) ? $name_sender : env('MAIL_SENDER_NAME','Laravel Vue Starter');
        /** @var array|Collection $to */
        $to = (is_a($to, Collection::class)) ? $to->toArray() : $to;
        $cc = (is_a($cc, Collection::class)) ? $cc->toArray() : $cc;
        try {
            Mail::send(
                $template,
                $data,
                function (Message $message) use ($from, $to, $subject, $name_sender, $name_user, $files, $cc) {
                    $message->from($from, $name_sender);
                    $message->to($to, $name_user);
                    $message->subject($subject);

                    if ($cc) {
                        $message->cc($cc);
                    }

                    if ($files) {
                        foreach ($files as $file) {
                            if (is_array($file)) {
                                $message->attach($file['path'], $file);
                                continue;
                            }
                            $message->attach($file);
                        }
                    }
                });
        }catch (\Exception $e){
            Mail::send(
                $template,
                $data,
                function (Message $message) use ($from, $to, $subject, $name_sender, $name_user, $files, $cc) {
                    $message->from($from, $name_sender);
                    $message->to($to, $name_user);
                    $message->subject($subject);

                    if ($files) {
                        foreach ($files as $file) {
                            if (is_array($file)) {
                                $message->attach($file['path'], $file);
                                continue;
                            }
                            $message->attach($file);
                        }
                    }
                });
        }
    }
}