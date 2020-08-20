<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Form\CompteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Validator\Constraints\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/Compte", name="compte")
     */
    public function index(Request $request)
    {

        $compte = new Compte();
        $form = $this->createForm(CompteType::class, $compte);
        if ($request->isMethod('POST')) {
            if ($form->handleRequest($request)->isValid()) {
                $db = $this->getDoctrine()->getManager();
                $db->persist($compte);
                $db->flush();
                $a = $compte->getId();
                // var_dump($a);
                // die;
                if ($a != null) {
                    $data['ok'] = 1;
                    $data['comptes'] = $db->getRepository(Compte::class)->findAll();
                    return $this->render("compte/liste.html.twig", $data);
                } else {
                    $data['ok'] = 0;
                    $data['form'] = $form->createView();
                    return $this->render("compte/index.html.twig",$data);
                }
            } else {
                $data['vide'] = 1;
                $data['form'] = $form->createView();
                $this->render("compte/index.html.twig", $data);
            }
        } else {

            return $this->render('compte/index.html.twig', [
                'controller_name' => 'CompteController',
                "form" => $form->createView()
            ]);
        }
    }
}
