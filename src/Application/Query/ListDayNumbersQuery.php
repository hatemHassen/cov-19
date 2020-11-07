<?php


namespace App\Application\Query;

use App\Domain\Model\DayNumbers\DayNumbers;
use App\Domain\Model\DayNumbers\DayNumbersEvent;
use App\Domain\Model\DayNumbers\DayNumbersEvent as DayNumbersEventAlias;
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
     * @return ArrayCollection|DayNumbers[]
     */
    public function execute(): ArrayCollection
    {
        $list = $this->dayNumbersRepository->getList();
        foreach ($list as $configuration) {
            $this->eventDispatcher->dispatch(
                new DayNumbersEventAlias($configuration),
                DayNumbersEvents::LISTED
            );
        }

        return $list;
    }

}