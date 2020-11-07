<?php


namespace App\Domain\Model\DayNumbers;

use Doctrine\Common\Collections\ArrayCollection;

interface DayNumbersRepositoryInterface
{
    public function getById(int $id): DayNumbers;
    public function create(DayNumbers $town): void;
    public function getList(int $limit = 0, int $offset = 0, string $orderBy = 'id',string $direction = 'DESC'): ArrayCollection;
    public function sumField($field): int;
}