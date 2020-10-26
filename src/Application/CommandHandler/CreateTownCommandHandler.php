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
    protected const  CREATED = 'article.configuration';

    private $configurationRepository;
    private $eventDispatcher;

    public function __construct(TownRepositoryInterface $configurationRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->configurationRepository = $configurationRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(CreateTownCommand $command): void
    {

        $configuration = new Town(
            uniqid('', true),
            $command->getName()
        );

        $this->configurationRepository->create($configuration);
        $this->eventDispatcher->dispatch(new TownEvent($configuration),self::CREATED);

    }

}