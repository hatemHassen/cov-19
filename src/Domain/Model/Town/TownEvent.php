<?php


namespace App\Domain\Model\Town;


use App\Domain\Model\Town\Town;
use Symfony\Contracts\EventDispatcher\Event;

class TownEvent extends Event
{
    private $node;


    public function __construct(Town $node)
    {
        $this->node = $node;
    }

    /**
     * @return Town
     */
    public function getVersion(): Town
    {
        return $this->node;
    }
}