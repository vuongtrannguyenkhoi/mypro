<?php namespace Qdesign\Services\Email\Swiftmailer;

use Qdesign\Services\Email\EmailInterface;
class Email implements EmailInterface {


    public function sendEmail($emailTemplate,$data)
    {

        \Mail::send($emailTemplate, $data, function($message) use($data)
        {
            $message->to($data['toEmail'],$data['toEmailName'])->subject($data['subject']);
        });
    }
}

