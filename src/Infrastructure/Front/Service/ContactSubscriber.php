<?php


namespace App\Infrastructure\Front\Service;


use App\Domain\Model\Contact\ContactEvent;
use App\Domain\Model\Contact\ContactEvents;
use App\Domain\Model\Message\Message;
use App\Infrastructure\Service\Mailer;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class ContactSubscriber implements EventSubscriberInterface
{
    /**
     * @var Mailer
     */
    protected $mailer;
    /**
     * @var string
     */
    protected $to;
    /**
     * @var string
     */
    protected $subject;

    /**
     * ContactSubscriber constructor.
     * @param Mailer $mailer
     * @param ContainerInterface $container
     */
    public function __construct(Mailer $mailer, ContainerInterface $container)
    {
        $this->mailer = $mailer;
        $this->to = $container->getParameter('contact_mail');
        $this->subject = 'Un nouveau mail de contact';
    }


    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ContactEvents::CREATED => ['sendMail'],
        ];
    }

    public function sendMail(ContactEvent $contactEvent)
    {
        $contact = $contactEvent->getContact();
        $message = Message::fromContact($contact);
        $message->setSubject($this->subject);
        $message->setTo($this->to);
        $this->mailer->sendEmail($message);
    }
}