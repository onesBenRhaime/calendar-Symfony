<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_tache;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Entrer un nom valide')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'nom doit etre min {{ limit }} characters', maxMessage: 'nom doit etre max {{ limit }} characters')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
        message: 'nom Tache doit avoir que des lettres'
    )]
    private ?string $nom;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date;

    #[ORM\Column]
    private ?string $priorite = null;

    #[ORM\Column]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'taches')]
    #[ORM\JoinColumn(name: "id_projet", referencedColumnName: "id_projet")]
    private ?Projet $projet;

    public function getid_tache(): ?int
    {
        return $this->id_tache;
    }

    public function setIdTache(int $id_tache): self
    {
        $this->id_tache = $id_tache;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getPriorite(): ?string
    {
        return $this->priorite;
    }

    public function setPriorite(string $priorite): self
    {
        $this->priorite = $priorite;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;
        return $this;
    }
}
