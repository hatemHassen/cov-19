<?php


namespace App\Application\Command;


class ContactCommand
{
    /** @var string */
    private $name;
    /** @var string */
    private $email;
    /** @var string */
    private $message;

    /**
     * ContactCommand constructor.
     * @param string $name
     * @param string $email
     * @param string $message
     */
    public function __construct(string $name, string $email, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function getName()
    {
        return $this->name;
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
    public function getMessage(): string
    {
        return $this->message;
    }

}