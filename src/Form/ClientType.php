<?php

namespace App\Form;

use App\Entity\Client;
use Doctrine\DBAL\Types\BigIntType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,['label'=>'Nom','required'=>true])
            ->add('prenom',TextType::class,['label'=>'Prénom','required'=>true])
            ->add('tel',TextType::class,['label'=>'Téléphone','required'=>true])
            ->add('email',EmailType::class,['label'=>'Email','required'=>true])
            ->add('adresse',TextType::class,['label'=>'Adresse','required'=>true])

        ;   
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
