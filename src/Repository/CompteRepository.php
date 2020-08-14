<?php

namespace App\Repository;

use App\Entity\ClientPhysique;
use App\Entity\Compte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Compte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compte[]    findAll()
 * @method Compte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Compte::class);
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


    public function  getClientSalarie()
    {
        return $this->getEntityManager()->createQuery("SELECT c FROM App\Entity\ClientPhysique c")->getResult();
//        return $this->getEntityManager()->createQuery("select c from App\Entity\ClientPhysique c WHERE c.clientMoral is not null");
//    }
    }
    public function  getClientNonSalarie(){
        return $this->createNamedQuery("select c from ClientPhysique c WHERE c.clientMoral is  null");
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
     * @param int $id
     * @return TypeClient|null
     */
    public function  getTypeCompte(int $id){
        return $this->getEntityManager()->getRepository("TypeCompte")->find($id);
    }

    /**
     * @param Compte $compte
     * @return int|null
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public  function addCompte(\App\Entity\Compte $compte){
        $this->getEntityManager()->persist($compte);
        $this->getEntityManager()->flush();
        return $compte->getId();
    }

    // /**
    //  * @return Compte[] Returns an array of Compte objects
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
    public function findOneBySomeField($value): ?Compte
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
