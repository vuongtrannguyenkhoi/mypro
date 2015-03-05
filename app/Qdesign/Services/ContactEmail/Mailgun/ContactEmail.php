<?php namespace Qdesign\Services\ContactEmail\Mailgun;

use Qdesign\Services\ContactEmail\ContactEmailInterface;
use Qdesign\Services\Email\EmailInterface;
class ContactEmail implements ContactEmailInterface {

    /**
     * @var Swiftmailer
     */
    private $mailgun;

    public function __construct(EmailInterface $mailgun){

        $this->mailgun = $mailgun;
    }
    public function sendEmail($data)
    {


        $this->mailgun->sendEmail('emails.contact',$data);
        return 'Your message has been sent!';
    }
}