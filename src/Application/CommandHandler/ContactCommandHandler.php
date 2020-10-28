<?php


namespace App\Application\CommandHandler;


use App\Application\Command\ContactCommand;
use App\Domain\Model\Contact\Contact;
use App\Domain\Model\Contact\ContactEvent;
use App\Domain\Model\Contact\ContactRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ContactCommandHandler implements MessageHandlerInterface
{
    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * ContactCommandHandler constructor.
     * @param ContactRepositoryInterface $contactRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(ContactRepositoryInterface $contactRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->contactRepository = $contactRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param ContactCommand $command
     */
    public function __invoke(ContactCommand $command): void
    {

        $contact = new Contact(
            uniqid('', true),
            $command->getName(),
            $command->getEmail(),
            $command->getMessage()
        );

        $this->contactRepository->create($contact);
        $this->eventDispatcher->dispatch(new ContactEvent($contact), Contact::CREATED);

    }

}