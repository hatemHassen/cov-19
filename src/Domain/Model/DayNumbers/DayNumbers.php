<?php


namespace App\Domain\Model\DayNumbers;


use App\Domain\Model\Town\Town;

class DayNumbers
{
    /**
     * @var string
     */
    protected $id;
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
     * DayNumbers constructor.
     * @param string $id
     * @param int $newCases
     * @param int $newDeaths
     * @param int $newHealedCases
     * @param Town $town
     * @param \DateTime $date
     */
    public function __construct(string $id, int $newCases, int $newDeaths, int $newHealedCases, Town $town, \DateTime $date)
    {
        $this->id = $id;
        $this->newCases = $newCases;
        $this->newDeaths = $newDeaths;
        $this->newHealedCases = $newHealedCases;
        $this->town = $town;
        $this->date = $date;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return DayNumbers
     */
    public function setId(string $id): DayNumbers
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNewCases(): int
    {
        return $this->newCases;
    }

    /**
     * @param int $newCases
     * @return DayNumbers
     */
    public function setNewCases(int $newCases): DayNumbers
    {
        $this->newCases = $newCases;
        return $this;
    }

    /**
     * @return int
     */
    public function getNewDeaths(): int
    {
        return $this->newDeaths;
    }

    /**
     * @param int $newDeaths
     * @return DayNumbers
     */
    public function setNewDeaths(int $newDeaths): DayNumbers
    {
        $this->newDeaths = $newDeaths;
        return $this;
    }

    /**
     * @return int
     */
    public function getNewHealedCases(): int
    {
        return $this->newHealedCases;
    }

    /**
     * @param int $newHealedCases
     * @return DayNumbers
     */
    public function setNewHealedCases(int $newHealedCases): DayNumbers
    {
        $this->newHealedCases = $newHealedCases;
        return $this;
    }

    /**
     * @return Town
     */
    public function getTown(): Town
    {
        return $this->town;
    }

    /**
     * @param Town $town
     * @return DayNumbers
     */
    public function setTown(Town $town): DayNumbers
    {
        $this->town = $town;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return DayNumbers
     */
    public function setDate(\DateTime $date): DayNumbers
    {
        $this->date = $date;
        return $this;
    }


}