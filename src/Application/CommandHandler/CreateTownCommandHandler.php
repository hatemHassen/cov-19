<?php


namespace App\Application\CommandHandler;


use App\Application\Command\CreateTownCommand;
use App\Domain\Model\Town\Town;
use App\Domain\Model\Town\TownEvent;
use App\Domain\Model\Town\TownRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateTownCommandHandler implements MessageHandlerInterface
{
    protected const  CREATED = 'town.created';

    private $townRepository;
    private $eventDispatcher;

    /**
     * CreateTownCommandHandler constructor.
     * @param TownRepositoryInterface $townRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(TownRepositoryInterface $townRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->townRepository = $townRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param CreateTownCommand $command
     * @throws \Exception
     */
    public function __invoke(CreateTownCommand $command): void
    {

        $town = new Town(
            uniqid('', true),
            $command->getName()
        );

        $this->townRepository->create($town);
        $this->eventDispatcher->dispatch(new TownEvent($town),self::CREATED);

    }

}