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
    public function getDayNumbers(): DayNumbers
    {
        return $this->dayNumbers;
    }
}