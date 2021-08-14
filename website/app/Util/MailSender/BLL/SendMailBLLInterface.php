<?php

namespace App\Util\MailSender\BLL;


interface SendMailBLLInterface
{
    /**
     * @param string $to
     * @param array $data
     * @param string $template
     * @param string $subject
     * @param string $from
     * @param string $name_sender
     * @param string $name_user
     * @param array $files
     * @param string|array $cc
     * @return void
     */
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
    );
}