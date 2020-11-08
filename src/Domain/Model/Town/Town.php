<?php


namespace App\Domain\Model\Town;


use App\Domain\Model\DayNumbers\DayNumbers;
use App\Domain\Model\Patient\Patient;
use App\Domain\Traits\Timestampable;
use App\Infrastructure\Traits\SlugifyTrait;
use Exception;

class Town
{
    use SlugifyTrait;
    use Timestampable;

    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var array
     */
    protected $patients;

    /**
     * @var array
     */
    protected $dayNumbers;

    /**
     * Town constructor.
     * @param null $id
     * @param string|null $name
     * @throws Exception
     */
    public function __construct($id = null, string $name = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->color=$this->randomColor();
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Town
     */
    public function setName(string $name): Town
    {
        $this->name = $name;
        $this->setSlug($this->slugify($this->getName()));
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Town
     */
    public function setSlug(string $slug): Town
    {
        $this->slug = $slug;
        return $this;
    }


    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return self
     */
    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function randomColorPart() {
        return str_pad( dechex( random_int( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function randomColor() {
        return $this->randomColorPart() . $this->randomColorPart() . $this->randomColorPart();
    }
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name']
        );
    }

    /**
     * @return array
     */
    public function getPatients(): array
    {
        return $this->patients;
    }

    /**
     * @param Patient $patient
     * @return Town
     */
    public function addPatients(Patient $patient): Town
    {
        $this->patients[$patient->getId()] = $patient;
        return $this;
    }
    /**
     * @param Patient $patient
     * @return Town
     */
    public function removePatients(Patient $patient): Town
    {
       unset($this->patients[$patient->getId()]);
        return $this;
    }
    /**
     * @return array
     */
    public function getDayNumbers(): array
    {
        return $this->dayNumbers;
    }

    /**
     * @param DayNumbers $dayNumbers
     * @return Town
     */
    public function addDayNumbers(DayNumbers $dayNumbers): Town
    {
        $this->dayNumbers[$dayNumbers->getId()] = $dayNumbers;
        return $this;
    }

    /**
     * @param DayNumbers $dayNumbers
     * @return Town
     */
    public function removeDayNumbers(DayNumbers $dayNumbers): Town
    {
        unset($this->dayNumbers[$dayNumbers->getId()]);
        return $this;
    }
}