<?php


namespace App\Domain\Model\Patient;

use Doctrine\Common\Collections\ArrayCollection;

interface PatientRepositoryInterface
{
    public function getById(string $id): Patient;
    public function create(Patient $patient): void;
    public function delete(Patient $patient): void;
    public function flush(): void;
    public function getList(int $limit = 0, int $offset = 0,int $type = 1): ArrayCollection;
}