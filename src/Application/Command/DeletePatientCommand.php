<?php


namespace App\Application\Command;



class DeletePatientCommand
{
    /**
     * @var string |null
     */
    protected $id;

    /**
     * DeletePatientCommand constructor.
     * @param string|null $id
     */
    public function __construct(?string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

}