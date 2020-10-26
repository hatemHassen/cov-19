<?php


namespace App\Application\Query;


use App\Domain\Model\Town\Town;
use App\Domain\Model\Town\TownEvent;
use App\Domain\Model\Town\TownRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ListTownQuery implements Query
{

   protected const LISTED = 'configuration.listed';

    private $configurationRepository;
    private $eventDispatcher;

    public function __construct(
        TownRepositoryInterface $configurationRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->configurationRepository = $configurationRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return ArrayCollection|Town[]
     */
    public function execute(): ArrayCollection
    {
        $list = $this->configurationRepository->getList();
        foreach ($list as $configuration) {
            $this->eventDispatcher->dispatch(
                new TownEvent($configuration),
                self::LISTED
            );
        }

        return $list;
    }

}