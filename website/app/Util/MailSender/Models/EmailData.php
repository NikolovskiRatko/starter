<?php

namespace App\Util\MailSender\Models;


abstract class EmailData
{
    public $to;
    public $from;
    public $template;
    public $data;
    public $subject;
    public $name_sender;
    public $name_user;
    public $files;
    public $cc;
    public $bcc;
}