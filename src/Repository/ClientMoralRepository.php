<?php

namespace App\Repository;

use App\Entity\ClientPhysique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientPhysique|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientPhysique|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientPhysique[]    findAll()
 * @method ClientPhysique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientMoralRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientPhysique::class);
    }

    /**
     * @param $id
     * @return ClientPhysique|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getClientMoral($id): ?ClientPhysique
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id= :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @return ClientPhysique[]
     */
    public function listeClientMorals()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param ClientPhysique $clientMoral
     * @return int|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public  function  addClientMooral(ClientPhysique $clientMoral){
        $this->getEntityManager()->persist($clientMoral);
        $this->getEntityManager()->flush();
        return $clientMoral->getId();
    }

    // /**
    //  * @return ClientMoral[] Returns an array of ClientMoral objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClientMoral
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
