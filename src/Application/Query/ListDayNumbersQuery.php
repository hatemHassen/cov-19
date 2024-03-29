<?php


namespace App\Application\Query;

use App\Domain\Model\DayNumbers\DayNumbersEvent;
use App\Domain\Model\DayNumbers\DayNumbersEvents;
use App\Domain\Model\DayNumbers\DayNumbersRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ListDayNumbersQuery implements Query
{
    private $dayNumbersRepository;
    private $eventDispatcher;

    public function __construct(
        DayNumbersRepositoryInterface $dayNumbersRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->dayNumbersRepository = $dayNumbersRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $args
     * @return ArrayCollection
     */
    public function execute(array $args = []): ArrayCollection
    {
        $list = $this->dayNumbersRepository->getList();
        foreach ($list as $dayNumbers) {
            $this->eventDispatcher->dispatch(
                new DayNumbersEvent($dayNumbers),
                DayNumbersEvents::LISTED
            );
        }

        return $list;
    }

}