<?php


namespace App\Application\Command;

use App\Domain\Model\Town\Town;

class CreatePatientCommand
{
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $lastName;
    /**
     * @var
     */
    protected $firstName;
    /**
     * @var int
     */
    protected $gender;
    /**
     * @var integer
     */
    protected $age;
    /**
     * @var Town
     */
    protected $town;
    /**
     * @var string
     */
    protected $zipCode;
    /**
     * @var string
     */
    protected $street;
    /**
     * @var string
     */
    protected $phone;
    /**
     * @var string
     */
    protected $mobile;
    /**
     * @var array
     */
    protected $antecedent;
    /**
     * @var array
     */
    protected $treatment;
    /**
     * @var array
     */
    protected $symptoms;
    /**
     * @var \DateTime
     */
    protected $symptomsStartDate;
    /**
     * @var boolean
     */
    protected $doctorVisited;
    /**
     * @var boolean
     */
    protected $emergencyVisited;
    /**
     * @var float
     */
    protected $temperature;
    /**
     * @var float
     */
    protected $breathingFrequency;
    /**
     * @var float
     */
    protected $oxygenSaturation;
    /**
     * @var float
     */
    protected $heartBeat;

    /**
     * CreatePatientCommand constructor.
     * @param string $email
     * @param string $lastName
     * @param $firstName
     * @param int $gender
     * @param int $age
     * @param Town $town
     * @param string $zipCode
     * @param string $street
     * @param string $mobile
     * @param string|null $phone
     * @param array $antecedent
     * @param array $treatment
     * @param array $symptoms
     * @param \DateTime|null $symptomsStartDate
     * @param bool $doctorVisited
     * @param bool $emergencyVisited
     * @param float|null $temperature
     * @param float|null $breathingFrequency
     * @param float|null $oxygenSaturation
     * @param float|null $heartBeat
     */
    public function __construct(string $email, string $lastName, $firstName, int $gender, int $age, Town $town, string $zipCode, string $street, string $mobile , string $phone = null, array $antecedent = [], array $treatment = [], array $symptoms = [], \DateTime $symptomsStartDate = null , bool $doctorVisited = false, bool $emergencyVisited = false, float $temperature = null, float $breathingFrequency = null, float $oxygenSaturation = null, float $heartBeat = null)
    {
        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->gender = $gender;
        $this->age = $age;
        $this->town = $town;
        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->phone = $phone;
        $this->mobile = $mobile;
        $this->antecedent = $antecedent;
        $this->treatment = $treatment;
        $this->symptoms = $symptoms;
        $this->symptomsStartDate = $symptomsStartDate;
        $this->doctorVisited = $doctorVisited;
        $this->emergencyVisited = $emergencyVisited;
        $this->temperature = $temperature;
        $this->breathingFrequency = $breathingFrequency;
        $this->oxygenSaturation = $oxygenSaturation;
        $this->heartBeat = $heartBeat;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return int
     */
    public function getGender(): int
    {
        return $this->gender;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return Town
     */
    public function getTown(): Town
    {
        return $this->town;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @return array
     */
    public function getAntecedent(): array
    {
        return $this->antecedent;
    }

    /**
     * @return array
     */
    public function getTreatment(): array
    {
        return $this->treatment;
    }

    /**
     * @return array
     */
    public function getSymptoms(): array
    {
        return $this->symptoms;
    }

    /**
     * @return \DateTime
     */
    public function getSymptomsStartDate(): \DateTime
    {
        return $this->symptomsStartDate;
    }

    /**
     * @return bool
     */
    public function isDoctorVisited(): bool
    {
        return $this->doctorVisited;
    }

    /**
     * @return bool
     */
    public function isEmergencyVisited(): bool
    {
        return $this->emergencyVisited;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return float
     */
    public function getBreathingFrequency(): float
    {
        return $this->breathingFrequency;
    }

    /**
     * @return float
     */
    public function getOxygenSaturation(): float
    {
        return $this->oxygenSaturation;
    }

    /**
     * @return float
     */
    public function getHeartBeat(): float
    {
        return $this->heartBeat;
    }

}