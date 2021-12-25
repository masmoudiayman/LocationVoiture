<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom',TextType::class,['label'=>'Nom','required'=>true])
            ->add('matricule',TextType::class,['label'=>'Matricule','required'=>true])
            ->add('description',TextType::class,['label'=>'Description'])
            ->add('photo',FileType::class,['label'=>'Photo','required'=>true,'mapped'=>false])
            ->add('prix',TextType::class,['label'=>'Prix','required'=>true])
            ->add('modele',TextType::class,['label'=>'Modéle','required'=>true])
        ;
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
