<?php


namespace App\Application\CommandHandler;


use App\Application\Command\CreatePatientCommand;
use App\Domain\Model\Patient\Patient;
use App\Domain\Model\Patient\PatientEvent;
use App\Domain\Model\Patient\PatientEvents;
use App\Domain\Model\Patient\PatientRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreatePatientCommandHandler implements MessageHandlerInterface
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
     * @param CreatePatientCommand $command
     * @throws \Exception
     */
    public function __invoke(CreatePatientCommand $command): void
    {

        $patient = new Patient(
            uniqid('', true),
            $command->getEmail(),
            $command->getLastName(),
            $command->getFirstName(),
            $command->getGender(),
            $command->getAge(),
            $command->getTown(),
            $command->getZipCode(),
            $command->getStreet(),
            $command->getMobile(),
            $command->getPhone(),
            $command->getAntecedent(),
            $command->getTreatment(),
            $command->getSymptoms(),
            $command->getSymptomsStartDate(),
            $command->isDoctorVisited(),
            $command->isEmergencyVisited(),
            $command->getTemperature(),
            $command->getBreathingFrequency(),
            $command->getOxygenSaturation(),
            $command->getHeartBeat(),
            $command->getStatus(),
            $command->getType(),
            $command->getComment()
        );

        $this->patientRepository->create($patient);
        $this->eventDispatcher->dispatch(new PatientEvent($patient),PatientEvents::CREATED);

    }

}