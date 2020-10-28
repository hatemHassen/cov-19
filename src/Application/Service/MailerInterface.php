<?php


namespace App\Application\Service;


use App\Domain\Model\Message\Message;

interface MailerInterface
{
    public function sendEmail(Message $message);
}