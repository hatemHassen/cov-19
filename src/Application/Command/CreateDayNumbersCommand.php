<?php


namespace App\Application\Command;

use App\Domain\Model\Town\Town;

class CreateDayNumbersCommand
{
    /**
     * @var int
     */
    protected $newCases;
    /**
     * @var int
     */
    protected $newDeaths;

    /**
     * @var int
     */
    protected $newHealedCases;
    /**
     * @var Town
     */
    protected $town;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * CreateDayNumbersCommand constructor.
     * @param int $newCases
     * @param int $newDeaths
     * @param int $newHealedCases
     * @param Town $town
     * @param \DateTime $date
     */
    public function __construct(int $newCases, int $newDeaths, int $newHealedCases, Town $town, \DateTime $date)
    {
        $this->newCases = $newCases;
        $this->newDeaths = $newDeaths;
        $this->newHealedCases = $newHealedCases;
        $this->town = $town;
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getNewCases(): int
    {
        return $this->newCases;
    }

    /**
     * @return int
     */
    public function getNewDeaths(): int
    {
        return $this->newDeaths;
    }

    /**
     * @return int
     */
    public function getNewHealedCases(): int
    {
        return $this->newHealedCases;
    }

    /**
     * @return Town
     */
    public function getTown(): Town
    {
        return $this->town;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

}