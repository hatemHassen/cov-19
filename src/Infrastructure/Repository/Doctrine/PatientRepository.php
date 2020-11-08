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
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

class PatientRepository extends ServiceEntityRepository implements PatientRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    /**
     * @param string $id
     * @return Patient
     * @throws NonUniqueResultException
     * @throws PatientException
     */
    public function getById(string $id): Patient
    {
        $q = $this->createQueryBuilder('q');
        $patient = $q->where($q->expr()->eq('q.id', ':id'))
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        if (null === $patient) {
            throw new PatientException("Patient doesn't exist.");
        }
        return $patient;
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
     * @param Patient $patient
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Patient $patient): void
    {
        $this->_em->remove($patient);
        $this->_em->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function flush(): void
    {
        $this->_em->flush();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param int $type
     * @return ArrayCollection
     */
    public function getList(int $limit = 0, int $offset = 0, int $type = 1): ArrayCollection
    {
        $q = $this->createQueryBuilder('p');
        $q->where($q->expr()->eq('p.type', ':type'));
        $q->setParameter('type', $type);
        if ($offset > 0) {
            $q->setFirstResult($offset);
        }

        if ($limit > 0) {
            $q->setMaxResults($limit);
        }

        $result = $q->getQuery()->getResult();
        $collection = new ArrayCollection();
        foreach ($result as $row) {
            $collection->set($row->getId(), $row);
        }

        return $collection;
    }
}