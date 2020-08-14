<?php

namespace App\Repository;

use App\Entity\ClientMoral;
use App\Entity\ClientPhysique;
use App\Entity\TypeClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientPhysique|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientPhysique|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientPhysique[]    findAll()
 * @method ClientPhysique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientPhysiqueRepository extends ServiceEntityRepository
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
    public function getClientPhysique($id): ?ClientPhysique
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
    public function listeClientPhysiques()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return array|ClientMoral[]
     */
    public function  listeClientMorals(){
        return $this->getEntityManager()->getRepository("ClientMoral")->findAll();
    }

    /**
     * @return array|TypeClient[]
     */
    public function  listeTypeClients(){
        return $this->getEntityManager()->getRepository("TypeClient")->findAll();
    }

    /**
     * @param int $id
     * @return ClientMoral|null
     */
    public function  getClientMoral(int $id){
        return $this->getEntityManager()->getRepository("ClientMoral")->find($id);
    }

    /**
     * @param int $id
     * @return TypeClient|null
     */
    public function  getTypeClient(int $id){
        return $this->getEntityManager()->getRepository("TypeClient")->find($id);
    }

    /**
     * @param ClientPhysique $clientPhysique
     * @return int|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public  function addClientPhysique(\App\Entity\ClientPhysique $clientPhysique){
        $this->getEntityManager()->persist($clientPhysique);
        $this->getEntityManager()->flush();
        return $clientPhysique->getId();
    }

    public function  getClientSalarie(){
        return $this->getEntityManager()->createQuery("SELECT c FROM App\Entity\ClientPhysique c WHERE c.clientMoral is not null")->getResult();
//        return $this->createNamedQuery("select c from ClientPhysique c WHERE c.clientMoral is not null");
    }

    public function  getClientNonSalarie(){
        return $this->getEntityManager()->createQuery("SELECT c FROM App\Entity\ClientPhysique c WHERE c.clientMoral is null")->getResult();
//        return $this->createNamedQuery("select c from ClientPhysique c WHERE c.clientMoral is  null");
    }

    // /**
    //  * @return ClientPhysique[] Returns an array of ClientPhysique objects
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
    public function findOneBySomeField($value): ?ClientPhysique
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
