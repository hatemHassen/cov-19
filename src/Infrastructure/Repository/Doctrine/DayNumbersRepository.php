<?php


namespace App\Infrastructure\Repository\Doctrine;


use App\Domain\Model\DayNumbers\DayNumbers;
use App\Domain\Model\DayNumbers\DayNumbersException;
use App\Domain\Model\DayNumbers\DayNumbersRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class DayNumbersRepository extends ServiceEntityRepository implements DayNumbersRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DayNumbers::class);
    }
    /**
     * @param int $id
     * @return DayNumbers
     * @throws DayNumbersException
     * @throws NonUniqueResultException
     */
    public function getById(int $id): DayNumbers
    {
        $result = $this->createQueryBuilder('q')
            ->where(['id' => $id])
            ->getQuery()
            ->setHydrationMode(Query::HYDRATE_ARRAY)
            ->getOneOrNullResult();

        if (null === $result) {
            throw new DayNumbersException("NumberDays doesn't exist.");
        }

        return DayNumbers::fromArray($result);
    }

    /**
     * @param DayNumbers $DayNumbers
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(DayNumbers $DayNumbers): void
    {
        $this->_em->persist($DayNumbers);
        $this->_em->flush();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $orderBy
     * @param string $direction
     * @return ArrayCollection
     */
    public function getList(int $limit = 0, int $offset = 0, string $orderBy = 'id',string $direction = 'DESC'): ArrayCollection
    {
        $q = $this->createQueryBuilder('q');

        if ($offset > 0) {
            $q->setFirstResult($offset);
        }

        if ($limit > 0) {
            $q->setMaxResults($limit);
        }

        $q->orderBy('q.'.$orderBy,$direction);

        $result = $q->getQuery()->getResult();
        $collection = new ArrayCollection();
        foreach ($result as $row) {
            $collection->set($row->getId(), $row);
        }

        return $collection;
    }
}