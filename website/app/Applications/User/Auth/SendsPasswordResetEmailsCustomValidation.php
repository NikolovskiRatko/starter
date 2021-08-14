<?php

namespace App\Applications\User\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

trait SendsPasswordResetEmailsCustomValidation
{
    use SendsPasswordResetEmails;
    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $messages = [
            'required' => 'validation.custom.email.required',
            'email'=> 'validation.custom.email.email',
            'exists' => 'validation.custom.email.exists'
        ];
        $request->validate(['email' => 'required|email|exists:users'],$messages);
    }

}
