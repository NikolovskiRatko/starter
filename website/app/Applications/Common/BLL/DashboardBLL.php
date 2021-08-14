<?php

namespace App\Applications\Common\BLL;

use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

/**
 *
 */
class DashboardBLL implements DashboardBLLInterface
{


    public function __construct(
    )
    {
    }

    public function getDashboardInformation(){
        $data = [];
        return $data;
    }

    public function contact($request){
        $data = [
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'message' => $request->input('message'),
            'subject' => $request->input('subject')
        ];
        Mail::to(env('MAIL_CONTACT', 'contact@mousebags.net'))
            ->send(new Contact($data));
        return ['mail_sent' => 'mail_sent'];
    }
}
