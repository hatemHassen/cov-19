<?php


namespace App\Domain\Model\Patient;


class Patient
{
    /**
     * @var string
     */
    protected $id;

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
     * Patient constructor.
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
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Patient
     */
    public function setId(string $id): Patient
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Patient
     */
    public function setEmail(string $email): Patient
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Patient
     */
    public function setLastName(string $lastName): Patient
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     * @return Patient
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return int
     */
    public function getGender(): int
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     * @return Patient
     */
    public function setGender(int $gender): Patient
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return Patient
     */
    public function setAge(int $age): Patient
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Patient
     */
    public function setCity(string $city): Patient
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return Patient
     */
    public function setZipCode(string $zipCode): Patient
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return Patient
     */
    public function setStreet(string $street): Patient
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Patient
     */
    public function setPhone(string $phone): Patient
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     * @return Patient
     */
    public function setMobile(string $mobile): Patient
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return array
     */
    public function getAntecedent(): array
    {
        return $this->antecedent;
    }

    /**
     * @param array $antecedent
     * @return Patient
     */
    public function setAntecedent(array $antecedent): Patient
    {
        $this->antecedent = $antecedent;
        return $this;
    }

    /**
     * @return array
     */
    public function getTreatment(): array
    {
        return $this->treatment;
    }

    /**
     * @param array $treatment
     * @return Patient
     */
    public function setTreatment(array $treatment): Patient
    {
        $this->treatment = $treatment;
        return $this;
    }

    /**
     * @return array
     */
    public function getSymptoms(): array
    {
        return $this->symptoms;
    }

    /**
     * @param array $symptoms
     * @return Patient
     */
    public function setSymptoms(array $symptoms): Patient
    {
        $this->symptoms = $symptoms;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSymptomsStartDate(): \DateTime
    {
        return $this->symptomsStartDate;
    }

    /**
     * @param \DateTime $symptomsStartDate
     * @return Patient
     */
    public function setSymptomsStartDate(\DateTime $symptomsStartDate): Patient
    {
        $this->symptomsStartDate = $symptomsStartDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDoctorVisited(): bool
    {
        return $this->doctorVisited;
    }

    /**
     * @param bool $doctorVisited
     * @return Patient
     */
    public function setDoctorVisited(bool $doctorVisited): Patient
    {
        $this->doctorVisited = $doctorVisited;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEmergencyVisited(): bool
    {
        return $this->emergencyVisited;
    }

    /**
     * @param bool $emergencyVisited
     * @return Patient
     */
    public function setEmergencyVisited(bool $emergencyVisited): Patient
    {
        $this->emergencyVisited = $emergencyVisited;
        return $this;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     * @return Patient
     */
    public function setTemperature(float $temperature): Patient
    {
        $this->temperature = $temperature;
        return $this;
    }

    /**
     * @return float
     */
    public function getBreathingFrequency(): float
    {
        return $this->breathingFrequency;
    }

    /**
     * @param float $breathingFrequency
     * @return Patient
     */
    public function setBreathingFrequency(float $breathingFrequency): Patient
    {
        $this->breathingFrequency = $breathingFrequency;
        return $this;
    }

    /**
     * @return float
     */
    public function getOxygenSaturation(): float
    {
        return $this->oxygenSaturation;
    }

    /**
     * @param float $oxygenSaturation
     * @return Patient
     */
    public function setOxygenSaturation(float $oxygenSaturation): Patient
    {
        $this->oxygenSaturation = $oxygenSaturation;
        return $this;
    }

    /**
     * @return float
     */
    public function getHeartBeat(): float
    {
        return $this->heartBeat;
    }

    /**
     * @param float $heartBeat
     * @return Patient
     */
    public function setHeartBeat(float $heartBeat): Patient
    {
        $this->heartBeat = $heartBeat;
        return $this;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['lastName'],
            $data['firstName'],
            $data['email'],
            $data['gender'],
            $data['age'],
            $data['city'],
            $data['zipCode'],
            $data['street'],
            $data['phone'],
            $data['mobile'],
            $data['antecedent'],
            $data['treatment'],
            $data['symptoms'],
            $data['symptomsStartDate'],
            $data['doctorVisited'],
            $data['emergencyVisited'],
            $data['temperature'],
            $data['breathingFrequency'],
            $data['oxygenSaturation'],
            $data['heartBeat']
        );
    }
}