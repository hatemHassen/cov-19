<?php


namespace App\Infrastructure\Service;


use App\Application\Service\MailerInterface;
use App\Domain\Model\Message\Message;
use Symfony\Component\Mailer\MailerInterface as SymfonyMailer;
use Symfony\Component\Mime\Email;

class Mailer implements MailerInterface
{
    /**
     * @var SymfonyMailer
     */
    protected $mailer;

    /**
     * Mailer constructor.
     * @param SymfonyMailer $mailer
     */
    public function __construct(SymfonyMailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendEmail(Message $message):void
    {
        $email = (new Email())
            ->from($message->getFrom())
            ->to($message->getTo())
            ->subject($message->getSubject())
            ->html($message->getMessage());
        if ($message->getCc()) {
            $email->cc($message->getCc());
        }
        if ($message->getBcc()) {
            $email->bcc($message->getBcc());
        }
       $this->mailer->send($email);

    }
}