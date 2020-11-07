<?php


namespace App\Application\Query;

use App\Domain\Model\Contact\Contact;
use App\Domain\Model\Contact\ContactEvent;
use App\Domain\Model\Contact\ContactEvent as ContactEventAlias;
use App\Domain\Model\Contact\ContactEvents;
use App\Domain\Model\Contact\ContactRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ListContactQuery implements Query
{

    private $contactRepository;
    private $eventDispatcher;

    public function __construct(
        ContactRepositoryInterface $contactRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->contactRepository = $contactRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $args
     * @return ArrayCollection
     */
    public function execute(array $args = []): ArrayCollection
    {
        $list = $this->contactRepository->getList();
        foreach ($list as $contact) {
            $this->eventDispatcher->dispatch(
                new ContactEventAlias($contact),
                ContactEvents::LISTED
            );
        }

        return $list;
    }

}