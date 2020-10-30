<?php


namespace App\Infrastructure\Repository\Doctrine;


use App\Domain\Model\Patient\Patient;
use App\Domain\Model\Patient\PatientException;
use App\Domain\Model\Patient\PatientRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class PatientRepository extends ServiceEntityRepository implements PatientRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }
    /**
     * @param int $id
     * @return Patient
     * @throws PatientException
     * @throws NonUniqueResultException
     */
    public function getById(int $id): Patient
    {
        $result = $this->createQueryBuilder('q')
            ->where(['id' => $id])
            ->getQuery()
            ->setHydrationMode(Query::HYDRATE_ARRAY)
            ->getOneOrNullResult();

        if (null === $result) {
            throw new PatientException("Patient doesn't exist.");
        }

        return Patient::fromArray($result);
    }

    /**
     * @param Patient $patient
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Patient $patient): void
    {
        $this->_em->persist($patient);
        $this->_em->flush();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return ArrayCollection|Patient[]
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
            $collection->set($row['id'], Patient::fromArray($row));
        }

        return $collection;
    }
}