<?php

namespace App\Applications\User\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;

trait ResetsPasswordsCustomResponse
{
    use ResetsPasswords;

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'required' => 'validation.required',
            'email'=> 'validation.email',
            'confirmed' => 'validation.confirmed',
            'min' => 'validation.min.numeric'
        ];
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(["message"=>"The given data was invalid.","errors"=>["error"=>[$response]]], 422);
    }
}
