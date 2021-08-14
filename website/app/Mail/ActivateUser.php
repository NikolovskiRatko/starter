<?php

namespace App\Mail;

use App\Applications\User\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user to activate
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_activate')
            ->from(env('MAIL_SENDER', 'no-reply@mousebags.net'), env('MAIL_FROM_NAME', 'Mouse Bags'))
            ->subject('Mouse Bags - New user added ')
            ->with([
                'name' => $this->user->first_name.' '.$this->user->last_name,
                'url' => url('user/activate/').'/'.$this->user->activation_code
            ]);
    }
}
