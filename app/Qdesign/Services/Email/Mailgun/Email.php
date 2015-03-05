<?php namespace Qdesign\Services\Email\Mailgun;

use Qdesign\Services\Email\EmailInterface;
class Email implements EmailInterface {


    public function sendEmail($emailTemplate,$data)
    {

        \Mailgun::send($emailTemplate, $data, function($message) use($data)
        {
            $message->to($data['toEmail'],$data['toEmailName'])->subject($data['subject']);
        });
    }
}

