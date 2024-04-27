<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;



#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public ?int $id_projet ;
          
 
    
  

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank(message: 'Entrer un nom valide')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'nom doit etre min {{ limit }} characters', maxMessage: 'nom doit etre max {{ limit }} characters')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
        message: 'Nom projet doit avoir que des letters'
    )]
    public ?string $nom ;
     
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'Entrer une date valide')]
    #[Assert\LessThanOrEqual(propertyPath: "date_fin", message: "La date de fin doit être après la date de début.")]
    public ?\DateTimeInterface $date_debut ;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'Entrer une date valide')]
    public ?\DateTimeInterface $date_fin ;

    #[ORM\Column(length: 30)]
    #[Assert\NotBlank(message: 'Entrer une progression valide')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'progression doit etre min {{ limit }} characters', maxMessage: 'progression doit etre max {{ limit }} characters')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
        message: 'progression projet doit avoir que des letters'
    )]
    private ?String $progression = null;
    #[ORM\Column]
    private ?String $priorite = null;
    #[ORM\Column]
   /**
 * @ORM\Column(nullable=true)
 */
    
    private $image = 'default.jpg'; // ou tout autre valeur par défaut


/**
 * @ORM\OneToMany(targetEntity=Tache::class, mappedBy="projet", orphanRemoval=true)
 */

private $taches;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

    /**
     * @return Collection|Tache[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

   

    public function getIdProjet(): ?int
    {
        return $this->id_projet;
    }

    public function getNomProjet(): ?string
    {
        return $this->nom;
    }

    public function setNomProjet(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
    public function getProgression(): ?string
    {
        return $this->progression;
    }

    public function setProgression(string $progression): static
    {
        $this->progression = $progression;

        return $this;
    }
    public function getPriorite(): ?string
    {
        return $this->priorite;
    }

    public function setPriorite(string $priorite): static
    {
        $this->priorite = $priorite;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;
    
        return $this;
    }
    
  
}
