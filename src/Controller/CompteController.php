<?php

namespace App\Controller;

use App\Entity\ClientMoral;
use App\Entity\ClientPhysique;
use App\Entity\Compte;
use App\Entity\TypeCompte;
use App\Entity\TypeFrais;
use App\Repository\ClientPhysiqueRepository;
use App\Repository\CompteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/Compte", name="compte")
     */
    public function index(ManagerRegistry $em)
    {
        $compteDb = new ClientPhysiqueRepository($em,ClientPhysique::class);

        if(isset($_POST['ajouter'])){
    extract($_POST);

            if ($typeCompte == '1') {
                $solde = $solde - $frais;
            } else {
                if ($typeCompte == '4') {

                    $solde = $solde - $fraisBlocageCompte;
                }
            }
            $idClientphysique = NULL;
            if ($idClientNormal != '0' || $idClientSalarie != '0') {
                $idClientphysique = $idClientNormal != '0' ? (int) $idClientNormal : (int) $idClientSalarie;
            }
            $compte = new Compte();
            $compte->setClerib($clesRib);
            $compte->setNumero($clesRib);
            $compte->setSolde($solde);
            $compte->setClientPhysique($this->getDoctrine()->getRepository(ClientPhysique::class)->find($idClientphysique));
            $compte->setClientMoral($this->getDoctrine()->getRepository(ClientMoral::class)->find($idEmployeur));
            $compte->setTypeCompte($this->getDoctrine()->getRepository(TypeCompte::class)->find($typeCompte));
            $em = $this->getDoctrine()->getManager();
            $em->persist($compte);
            $em->flush();
            if($compte->getId()!= null){
                echo "Compte bien ajoute";

            } else {
                echo  "Echec d'ajout du Compte";
            }
            return  new Response();
        } else {
            $data['clientMorals'] = $this->getDoctrine()->getRepository(ClientMoral::class)->findAll();
            $data['typeComptes'] = $this->getDoctrine()->getRepository(TypeCompte::class)->findAll();
            $data['typeFrais'] = $this->getDoctrine()->getRepository(TypeFrais::class)->findAll();
            $data['clientPhysiques'] = $this->getDoctrine()->getRepository(ClientPhysique::class)->findAll();
            $data['clientPhysiquesalarie'] = $compteDb->getClientSalarie();
            $data['clientPhysiquesimple'] = $compteDb->getClientNonSalarie();
            $data['agiosOuverture'] = $this->getDoctrine()->getRepository(TypeFrais::class)->findOneBy(['libelle'=>'Agios']);
            $data['fraisOuverture'] = $this->getDoctrine()->getRepository(TypeFrais::class)->findOneBy(['libelle'=>'Frais Ouverture']);
            $data['fraisBlocageOuverture'] = $this->getDoctrine()->getRepository(TypeFrais::class)->findOneBy(['libelle'=>'Frais Blocage']);
//            var_dump($data['fraisOuverture']);
//            die;
                return $this->render('compte/index.html.twig', $data);

        }
    }
}
