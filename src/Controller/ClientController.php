<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/Client", name="client")
     */
    public function index(Request $request)
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if($form->isValid()){
                $db = $this->getDoctrine()->getManager();
                $db->persist($client);
                $db->flush();
                if($client->getId()!=null){
                    $data['ok']=1;
                    $data['clients'] = $db->getRepository(Client::class)->findAll();
                    return $this->render('client/liste.html.twig',$data);
                }else{
                    $data['ok']=0;
                    $data['form'] = $form->createView();
                    return $this->render('client/liste.html.twig',$data);
                }
                
            }else{
                $data['vide']=0;
                $data['form'] = $form->createView();
                return $this->render('client/index.html.twig',$data);
            }
        } else {

            return $this->render('client/index.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }
}
