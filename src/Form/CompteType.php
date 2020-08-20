<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Compte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero',TextType::class,array('label'=>'Numero Compte',"attr"=>array("class"=>"form-control")))
            ->add('dateCreate',TextType::class,array('label'=>'Date de Creation',"attr"=>array("class"=>"form-control")))
            ->add('solde',IntegerType::class,array('label'=>'Solde du Compte',"attr"=>array("class"=>"form-control")))
            ->add('client' , EntityType::class, [
                'class' => Client::class,
                'attr' => array ( 'class' => 'form-control')
            ])
            ->add('ajouter',SubmitType::class,array('label'=>'Ajouter',"attr"=>array("class"=>"btn btn-primary")))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
