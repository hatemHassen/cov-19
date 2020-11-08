<?php


namespace App\Application\CommandHandler;


use App\Application\Command\UpdatePatientCommand;
use App\Domain\Model\Patient\Patient;
use App\Domain\Model\Patient\PatientEvent;
use App\Domain\Model\Patient\PatientEvents;
use App\Domain\Model\Patient\PatientRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdatePatientCommandHandler implements MessageHandlerInterface
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
     * @param UpdatePatientCommand $command
     * @throws \Exception
     */
    public function __invoke(UpdatePatientCommand $command): void
    {
        $patient = $this->patientRepository->getById($command->getId());
        $patient->setEmail($command->getEmail());
        $patient->setLastName($command->getLastName());
        $patient->setFirstName($command->getFirstName());
        $patient->setAge($command->getAge());
        $patient->setTown($command->getTown());
        $patient->setStreet($command->getStreet());
        $patient->setMobile($command->getMobile());
        $patient->setPhone($command->getPhone());
        $patient->setAntecedent($command->getAntecedent());
        $patient->setTreatment($command->getTreatment());
        $patient->setSymptoms($command->getSymptoms());
        $patient->setSymptomsStartDate($command->getSymptomsStartDate());
        $patient->setEmergencyVisited($command->isEmergencyVisited());
        $patient->setDoctorVisited($command->isDoctorVisited());
        $patient->setTemperature($command->getTemperature());
        $patient->setBreathingFrequency($command->getBreathingFrequency());
        $patient->setOxygenSaturation($command->getOxygenSaturation());
        $patient->setHeartBeat($command->getHeartBeat());
        $patient->setStatus($command->getStatus());
        $patient->setType($command->getType());
        $patient->setComment($command->getComment());
        $this->patientRepository->flush();
        $this->eventDispatcher->dispatch(new PatientEvent($patient),PatientEvents::UPDATED);
    }

}