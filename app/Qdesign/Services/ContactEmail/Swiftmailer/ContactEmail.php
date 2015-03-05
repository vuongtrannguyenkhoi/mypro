<?php namespace Qdesign\Services\ContactEmail\Swiftmailer;

use Qdesign\Services\ContactEmail\ContactEmailInterface;
use Qdesign\Services\Email\EmailInterface;
class ContactEmail implements ContactEmailInterface {

    /**
     * @var Swiftmailer
     */
    private $swiftmailer;

    public function __construct(EmailInterface $swiftmailer){

        $this->swiftmailer = $swiftmailer;
    }
    public function sendEmail($data)
    {
        $this->swiftmailer->sendEmail('emails.contact',$data);
        return 'Your message has been sent!';
    }
}