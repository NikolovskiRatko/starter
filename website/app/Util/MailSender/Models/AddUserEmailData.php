<?php

namespace App\Util\MailSender\Models;

use App\Applications\User\Model\User;
use Illuminate\Support\Facades\Auth;

class AddUserEmailData extends EmailData
{
    public function __construct(User $user, $mails)
    {
        $this->to = $user->email;
//        $this->bcc = env('HELP_DESK_MAIL', 'helpdesk@icmpd.test');
        $this->subject = 'Laravel Vue Starter - New user added ';
        $this->from = env('MAIL_SENDER', 'no-reply@starter.test');
        $this->data = [
            'name' => $user->first_name . ' ' . $user->last_name,
            'url' => url('/')
        ];
        $this->template = 'emails.user_activate';
    }
}
