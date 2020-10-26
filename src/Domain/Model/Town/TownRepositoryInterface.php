<?php


namespace App\Domain\Model\Town;

use App\Domain\Model\Town\Town;
use Doctrine\Common\Collections\ArrayCollection;

interface TownRepositoryInterface
{
    public function getById(int $id): Town;

    public function getList(int $limit = 0, int $offset = 0): ArrayCollection;
}