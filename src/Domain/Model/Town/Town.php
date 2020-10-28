<?php


namespace App\Domain\Model\Town;


use App\Infrastructure\Traits\SlugifyTrait;
use Exception;

class Town
{
    use SlugifyTrait;

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
    private $color;

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


}