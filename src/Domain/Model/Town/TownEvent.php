<?php


namespace App\Domain\Model\Town;


use Symfony\Contracts\EventDispatcher\Event;

class TownEvent extends Event
{
    private $town;


    public function __construct(Town $town)
    {
        $this->town = $town;
    }

    /**
     * @return Town
     */
    public function getTown(): Town
    {
        return $this->town;
    }
}