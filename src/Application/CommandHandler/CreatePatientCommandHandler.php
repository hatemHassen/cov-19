<?php


namespace App\Application\CommandHandler;


use App\Application\Command\CreatePatientCommand;
use App\Domain\Model\Patient\Patient;
use App\Domain\Model\Patient\PatientEvent;
use App\Domain\Model\Patient\PatientRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreatePatientCommandHandler implements MessageHandlerInterface
{
    private $patientRepository;
    private $eventDispatcher;

    /**
     * CreatePatientCommandHandler constructor.
     * @param PatientRepositoryInterface $townRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(PatientRepositoryInterface $townRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->townRepository = $townRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param CreatePatientCommand $command
     * @throws \Exception
     */
    public function __invoke(CreatePatientCommand $command): void
    {

        $town = new Patient(
            uniqid('', true),
            $command->getName()
        );

        $this->townRepository->create($town);
        $this->eventDispatcher->dispatch(new PatientEvent($town),Patient::CREATED);

    }

}