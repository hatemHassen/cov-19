<?php


namespace App\Application\Query;

use App\Domain\Model\Patient\Patient;
use App\Domain\Model\Patient\PatientEvent;
use App\Domain\Model\Patient\PatientEvent as PatientEventAlias;
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
     * @return ArrayCollection|Patient[]
     */
    public function execute(): ArrayCollection
    {
        $list = $this->patientRepository->getList();
        foreach ($list as $configuration) {
            $this->eventDispatcher->dispatch(
                new PatientEventAlias($configuration),
                PatientEvents::LISTED
            );
        }

        return $list;
    }

}