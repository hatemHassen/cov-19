<?php


namespace App\Application\CommandHandler;


use App\Application\Command\CreateDayNumbersCommand;
use App\Domain\Model\DayNumbers\DayNumbers;
use App\Domain\Model\DayNumbers\DayNumbersEvent;
use App\Domain\Model\DayNumbers\DayNumbersEvents;
use App\Domain\Model\DayNumbers\DayNumbersRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateDayNumbersCommandHandler implements MessageHandlerInterface
{
    private $dayNumbersRepository;
    private $eventDispatcher;

    /**
     * CreateDayNumbersCommandHandler constructor.
     * @param DayNumbersRepositoryInterface $dayNumbersRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(DayNumbersRepositoryInterface $dayNumbersRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->dayNumbersRepository = $dayNumbersRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param CreateDayNumbersCommand $command
     * @throws \Exception
     */
    public function __invoke(CreateDayNumbersCommand $command): void
    {

        $town = new DayNumbers(
            uniqid('', true),
            $command->getNewCases(),
            $command->getNewDeaths(),
            $command->getNewHealedCases(),
            $command->getTown(),
            $command->getDate()
        );

        $this->dayNumbersRepository->create($town);
        $this->eventDispatcher->dispatch(new DayNumbersEvent($town),DayNumbersEvents::CREATED);

    }

}