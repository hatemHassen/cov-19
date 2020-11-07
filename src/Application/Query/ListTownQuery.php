<?php


namespace App\Application\Query;


use App\Domain\Model\Town\Town;
use App\Domain\Model\Town\TownEvent;
use App\Domain\Model\Town\TownEvents;
use App\Domain\Model\Town\TownRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ListTownQuery implements Query
{

    private $townRepository;
    private $eventDispatcher;

    public function __construct(
        TownRepositoryInterface $townRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->townRepository = $townRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $args
     * @return ArrayCollection
     */
    public function execute(array $args = []): ArrayCollection
    {
        $list = $this->townRepository->getList();
        foreach ($list as $configuration) {
            $this->eventDispatcher->dispatch(
                new TownEvent($configuration),
                TownEvents::LISTED
            );
        }

        return $list;
    }

}