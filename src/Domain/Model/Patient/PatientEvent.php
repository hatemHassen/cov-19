<?php


namespace App\Domain\Model\Patient;


use Symfony\Contracts\EventDispatcher\Event;

class PatientEvent extends Event
{
    private $patient;


    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
     * @return Patient
     */
    public function getPatient(): Patient
    {
        return $this->patient;
    }
}