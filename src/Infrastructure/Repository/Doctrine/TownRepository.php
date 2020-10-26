<?php


namespace App\Infrastructure\Repository\Doctrine;


use App\Domain\Model\Town\Town;
use App\Domain\Model\Town\TownException;
use App\Domain\Model\Town\TownRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class TownRepository extends ServiceEntityRepository implements TownRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Town::class);
    }
    /**
     * @param int $id
     * @return Town
     * @throws TownException
     * @throws NonUniqueResultException
     */
    public function getById(int $id): Town
    {
        $result = $this->createQueryBuilder('q')
            ->where(['id' => $id])
            ->getQuery()
            ->setHydrationMode(Query::HYDRATE_ARRAY)
            ->getOneOrNullResult();

        if (null === $result) {
            throw new TownException("Town doesn't exist.");
        }

        return Town::fromArray($result);
    }

    /**
     * @param Town $town
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Town $town): void
    {
        $this->_em->persist($town);
        $this->_em->flush();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return ArrayCollection|Town[]
     */
    public function getList(int $limit = 0, int $offset = 0): ArrayCollection
    {
        $q = $this->createQueryBuilder('q');

        if ($offset > 0) {
            $q->setFirstResult($offset);
        }

        if ($limit > 0) {
            $q->setMaxResults($limit);
        }

        $result = $q->getQuery()->getResult(Query::HYDRATE_ARRAY);

        $collection = new ArrayCollection();
        foreach ($result as $row) {
            $collection->set($row['id'], Town::fromArray($row));
        }

        return $collection;
    }
}