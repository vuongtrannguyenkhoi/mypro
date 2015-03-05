<?php namespace Qdesign\Services\Email;

interface EmailInterface {
    public function sendEmail($emailTemplate,$data);
}