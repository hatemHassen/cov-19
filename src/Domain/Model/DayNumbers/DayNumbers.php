<?php


namespace App\Domain\Model\DayNumbers;


use App\Domain\Model\Town\Town;
use App\Domain\Traits\Timestampable;

class DayNumbers
{
    use Timestampable;

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
    protected $newHealed;

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
     * @param int $newHealed
     * @param Town $town
     * @param \DateTime $date
     */
    public function __construct(string $id, int $newCases, int $newDeaths, int $newHealed, Town $town, \DateTime $date)
    {
        $this->id = $id;
        $this->newCases = $newCases;
        $this->newDeaths = $newDeaths;
        $this->newHealed = $newHealed;
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
        return $this->newHealed;
    }

    /**
     * @param int $newHealed
     * @return DayNumbers
     */
    public function setNewHealedCases(int $newHealed): DayNumbers
    {
        $this->newHealed = $newHealed;
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