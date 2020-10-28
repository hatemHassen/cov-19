<?php


namespace App\Infrastructure\Repository\Doctrine;


use App\Domain\Model\Contact\Contact;
use App\Domain\Model\Contact\ContactException;
use App\Domain\Model\Contact\ContactRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

class ContactRepository extends ServiceEntityRepository implements ContactRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @param int $id
     * @return Contact
     * @throws ContactException
     * @throws NonUniqueResultException
     */
    public function getById(int $id): Contact
    {
        $result = $this->createQueryBuilder('c')
            ->where(['id' => $id])
            ->getQuery()
            ->setHydrationMode(Query::HYDRATE_ARRAY)
            ->getOneOrNullResult();

        if (null === $result) {
            throw new ContactException("Contact doesn't exist.");
        }

        return Contact::fromArray($result);
    }

    /**
     * @param Contact $contact
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Contact $contact): void
    {
        $this->_em->persist($contact);
        $this->_em->flush();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return ArrayCollection|Contact[]
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
            $collection->set($row['id'], Contact::fromArray($row));
        }

        return $collection;
    }
}