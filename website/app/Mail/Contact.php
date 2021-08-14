<?php

namespace App\Mail;

use App\Applications\User\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The data array
     *
     * @var User
     */
    protected $data;

    /**
     * Create a new message instance.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact')
            ->from($this->data['email'], $this->data['name'])
//            ->replyTo('example@example.com')
//            ->bcc('example@example.com')
            ->subject($this->data['subject'])
            ->with([
                'url' => url('/'),
                'data' => $this->data
            ]);
    }
}
