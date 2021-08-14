<?php

namespace App\Factories;

use App\Applications\User\Model\User;
use App\Util\MailSender\Models\AddUserEmailData;
use Illuminate\Support\Facades\App;

class EmailDataFactory
{
    public static function createUserEmail(User $user, $mails = null)
    {
        return new AddUserEmailData($user, $mails);
    }
}
