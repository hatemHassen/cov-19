<?php


namespace App\Application\Query;

use App\Domain\Model\Patient\PatientEvent;
use App\Domain\Model\Patient\PatientEvents;
use App\Domain\Model\Patient\PatientRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ListPatientQuery implements Query
{
    private $patientRepository;
    private $eventDispatcher;

    public function __construct(
        PatientRepositoryInterface $patientRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->patientRepository = $patientRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $args
     * @return ArrayCollection
     */
    public function execute(array $args = []): ArrayCollection
    {
        $list = $this->patientRepository->getList();
        foreach ($list as $patient) {
            $this->eventDispatcher->dispatch(
                new PatientEvent($patient),
                PatientEvents::LISTED
            );
        }

        return $list;
    }

}