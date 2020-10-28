<?php


namespace App\Application\Query;

use App\Domain\Model\Contact\Contact;
use App\Domain\Model\Contact\ContactEvent;
use App\Domain\Model\Contact\ContactEvent as ContactEventAlias;
use App\Domain\Model\Contact\ContactRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ListContactQuery implements Query
{

    protected const LISTED = 'town.listed';

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
     * @return ArrayCollection|Contact[]
     */
    public function execute(): ArrayCollection
    {
        $list = $this->contactRepository->getList();
        foreach ($list as $configuration) {
            $this->eventDispatcher->dispatch(
                new ContactEventAlias($configuration),
                self::LISTED
            );
        }

        return $list;
    }

}