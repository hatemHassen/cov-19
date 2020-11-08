<?php


namespace App\Application\CommandHandler;


use App\Application\Command\DeletePatientCommand;
use App\Domain\Model\Patient\PatientEvent;
use App\Domain\Model\Patient\PatientEvents;
use App\Domain\Model\Patient\PatientRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DeletePatientCommandHandler implements MessageHandlerInterface
{
    private $patientRepository;
    private $eventDispatcher;

    /**
     * CreatePatientCommandHandler constructor.
     * @param PatientRepositoryInterface $patientRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(PatientRepositoryInterface $patientRepository, EventDispatcherInterface $eventDispatcher)
    {
        $this->patientRepository = $patientRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param DeletePatientCommand $command
     * @throws \Exception
     */
    public function __invoke(DeletePatientCommand $command): void
    {
        $patient = $this->patientRepository->getById($command->getId());
        $this->eventDispatcher->dispatch(new PatientEvent($patient), PatientEvents::BEFORE_DELETE);
        $this->patientRepository->delete($patient);
        $this->eventDispatcher->dispatch(new PatientEvent($patient), PatientEvents::DELETED);
    }

}