<?php


namespace App\Domain\Model\Patient;


use Symfony\Contracts\EventDispatcher\Event;

class PatientEvent extends Event
{
    private $contact;


    public function __construct(Patient $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return Patient
     */
    public function getContact(): Patient
    {
        return $this->contact;
    }
}