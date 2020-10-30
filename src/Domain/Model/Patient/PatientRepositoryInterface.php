<?php


namespace App\Domain\Model\Patient;

use Doctrine\Common\Collections\ArrayCollection;

interface PatientRepositoryInterface
{
    public function getById(int $id): Patient;
    public function create(Patient $contact): void;
    public function getList(int $limit = 0, int $offset = 0): ArrayCollection;
}