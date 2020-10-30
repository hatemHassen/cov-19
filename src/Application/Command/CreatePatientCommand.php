<?php


namespace App\Application\Command;


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
     * @var string
     */
    protected $city;
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
     * @param string $city
     * @param string $zipCode
     * @param string $street
     * @param string $phone
     * @param string $mobile
     * @param array $antecedent
     * @param array $treatment
     * @param array $symptoms
     * @param \DateTime $symptomsStartDate
     * @param bool $doctorVisited
     * @param bool $emergencyVisited
     * @param float $temperature
     * @param float $breathingFrequency
     * @param float $oxygenSaturation
     * @param float $heartBeat
     */
    public function __construct(string $email, string $lastName, $firstName, int $gender, int $age, string $city, string $zipCode, string $street, string $phone, string $mobile, array $antecedent, array $treatment, array $symptoms, \DateTime $symptomsStartDate, bool $doctorVisited, bool $emergencyVisited, float $temperature, float $breathingFrequency, float $oxygenSaturation, float $heartBeat)
    {
        $this->email = $email;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->gender = $gender;
        $this->age = $age;
        $this->city = $city;
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
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
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
    public function getPhone(): string
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

    public function getName()
    {
        return $this->name;
    }
}