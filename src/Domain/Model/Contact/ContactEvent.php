<?php


namespace App\Domain\Model\Contact;


use Symfony\Contracts\EventDispatcher\Event;

class ContactEvent extends Event
{
    private $contact;


    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }
}