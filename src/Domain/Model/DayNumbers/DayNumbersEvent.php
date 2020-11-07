<?php


namespace App\Domain\Model\DayNumbers;


use Symfony\Contracts\EventDispatcher\Event;

class DayNumbersEvent extends Event
{
    private $dayNumbers;


    public function __construct(DayNumbers $dayNumbers)
    {
        $this->dayNumbers = $dayNumbers;
    }

    /**
     * @return DayNumbers
     */
    public function getTown(): Town
    {
        return $this->dayNumbers;
    }
}