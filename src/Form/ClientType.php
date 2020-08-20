<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom',TextType::class,array('label'=>'Prenom','attr'=>array('class'=>'form-control')))
            ->add('nom',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('dateNaissance',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('lieuNaissance',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('adresse',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('telephone',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('email',EmailType::class,array('attr'=>array('class'=>'form-control')))
            ->add('ajouter',SubmitType::class,array('attr'=>array('class'=>'btn btn-primary')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
