<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Cascade;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date_debut;

    #[ORM\Column(type: 'date')]
    private $date_fin;

    #[ORM\Column(type: 'bigint')]
    private $prix_par_jour;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private $pk_client;

    #[ORM\ManyToOne(targetEntity: Voiture::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private $pk_voiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getPrixParJour(): ?string
    {
        return $this->prix_par_jour;
    }

    public function setPrixParJour(string $prix_par_jour): self
    {
        $this->prix_par_jour = $prix_par_jour;

        return $this;
    }

    public function getPkClient(): ?Client
    {
        return $this->pk_client;
    }

    public function setPkClient(?Client $pk_client): self
    {
        $this->pk_client = $pk_client;

        return $this;
    }

    public function getPkVoiture(): ?Voiture
    {
        return $this->pk_voiture;
    }

    public function setPkVoiture(?Voiture $pk_voiture): self
    {
        $this->pk_voiture = $pk_voiture;

        return $this;
    }
}
