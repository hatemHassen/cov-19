<?php


namespace App\Application\Query;

use App\Domain\Model\DayNumbers\DayNumbersRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ChartDataDayNumbersQuery implements Query
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
     * @return int
     */
    public function execute(array $args = []): array
    {
        return $this->dayNumbersRepository->chartData($args['type']);
    }

}