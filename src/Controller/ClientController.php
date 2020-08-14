<?php

namespace App\Controller;

use App\Entity\ClientMoral;
use App\Entity\ClientPhysique;
use App\Entity\TypeClient;
use App\Entity\TypeCompte;
use App\Repository\ClientMoralRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/Client", name="client")
     */
    public function index(EntityManagerInterface $em)
    {
        $data['typeClients'] = $this->getDoctrine()->getManager()->getRepository(TypeClient::class)->findAll();
        $data['clientMorals'] = $this->getDoctrine()->getManager()->getRepository(ClientMoral::class)->findAll();
//        var_dump($data['clientMorals']);
//        die;
        if(isset($_POST['ajouter'])){
//            var_dump($_POST);
            extract($_POST);

            if ($typeClient == '2') {
                $clientMoral = new ClientMoral();
                $clientMoral->setNom($nomClientMoral);
                $clientMoral->setNumero($numeroClientMoral);
                $clientMoral->setRaisonSocial($raisonSocial);

                $em = $this->getDoctrine()->getManager();
                $em->persist($clientMoral);
                $em->flush();
                $a = $clientMoral->getId();
                if($a!=null){
                    echo "Client Moral bien ajoute";
                }else {
                    echo "echec d'ajout du Client Moral";
                }

            }elseif ($typeClient=='1'){

                $clientPhysique = new ClientPhysique();

                if ($typeClientPhysique == '2' && $idEmployeur == '0') {
                    $clientMoral = new ClientMoral();
                    $clientMoral->setNom($nomClientMoral);
                    $clientMoral->setNumero($numeroClientMoral);
                    $clientMoral->setRaisonSocial($raisonSocial);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($clientMoral);
                    $em->flush();
                    $clientPhysique->setClientMoral($clientMoral);
                }else{
                    $clientPhysique->setClientMoral($this->getDoctrine()->getRepository(ClientMoral::class)->find($idEmployeur));
                }

                $clientPhysique->setNom($nom);
                $clientPhysique->setPrenom($prenom);
                $clientPhysique->setSalaire($salaire!="" ? $salaire : null);
                $clientPhysique->setTypeClient($this->getDoctrine()->getRepository(TypeClient::class)->find($typeClientPhysique));
                $this->getDoctrine()->getManager()->persist($clientPhysique);
                $this->getDoctrine()->getManager()->flush();
                if($clientPhysique->getId()!=null){
                    echo "Client Physique bien ajoute";
                } else {
                    echo "Echec d'ajout client Physique";
                }


            }
            return  new Response();
        }else{
            return $this->render('client/add.html.twig',
                $data);
        }

    }
}
