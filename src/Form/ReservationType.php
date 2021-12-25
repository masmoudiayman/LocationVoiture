<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Client;
use App\Entity\Voiture;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date_debut',DateType::class,['label'=>'Date de début','required'=>true])
        ->add('date_fin',DateType::class,['label'=>'Date de fin','required'=>true])
        ->add('prix_par_jour',TextType::class,['label'=>'Prix par jour','required'=>true])
        ->add('pk_client',EntityType::class,['class'=>Client::class,
              "choice_label"=> function(Client $client) {
                  return $client->getNom().' '.$client->getPrenom();
              },
              'label'=>'Sélectionner Client','multiple'=>False
              ])
        ->add('pk_voiture',EntityType::class,['class'=>Voiture::class,
              "choice_label"=> function(Voiture $voiture) {
                  return $voiture->getNom().' du marque '. $voiture->getModele().' avec la matricule :'. $voiture->getMatricule();
              },
              'label'=>'Séléctionner Voiture','multiple'=>False
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
