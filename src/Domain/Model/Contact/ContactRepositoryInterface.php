<?php


namespace App\Domain\Model\Contact;

use Doctrine\Common\Collections\ArrayCollection;

interface ContactRepositoryInterface
{
    public function getById(int $id): Contact;
    public function create(Contact $contact): void;
    public function getList(int $limit = 0, int $offset = 0): ArrayCollection;
}