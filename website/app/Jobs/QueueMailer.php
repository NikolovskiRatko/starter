<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Util\MailSender\BLL\SendMailBLLInterface;
use App\Util\MailSender\Models\EmailData;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * @property SendMailBLLInterface $mailer
 */
class QueueMailer extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $data;

    public function setData(EmailData $email_data)
    {
        $this->data = $email_data;
    }

    /**
     * Execute the job.
     *
     * @param SendMailBLLInterface $mailer
     */
    public function handle(SendMailBLLInterface $mailer)
    {
        $mailer->sendMail(
            $this->data->to,
            $this->data->data,
            $this->data->template,
            $this->data->subject,
            $this->data->from,
            $this->data->name_sender,
            $this->data->name_user,
            $this->data->files,
            $this->data->cc
        );
    }
}
