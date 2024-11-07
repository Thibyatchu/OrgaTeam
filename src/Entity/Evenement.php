<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank]
    private ?string $Nom = null;
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $lieu = null;

    /**
     * @var Collection<int, Club>
     */
    #[ORM\ManyToMany(targetEntity: Club::class, mappedBy: 'evenement')]
    private Collection $clubs;

    /**
     * @var Collection<int, Equipe>
     */
    #[ORM\OneToMany(targetEntity: Equipe::class, mappedBy: 'evenement')]
    private Collection $equipes;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?TypeEvenement $evenements = null;

    /**
     * @var Collection<int, Equipe>
     */
    #[ORM\ManyToMany(targetEntity: Equipe::class, inversedBy: 'evenements')]
    private Collection $equipe;

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipe(): Collection
    {
        return $this->equipe;
    }

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
        $this->equipes = new ArrayCollection();
        $this->equipe = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(?string $Nom): static
    {
        $this->Nom = $Nom;

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

    /**
     * @return Collection<int, Club>
     */
    public function getClubs(): Collection
    {
        return $this->clubs;
    }

    public function addClub(Club $club): static
    {
        if (!$this->clubs->contains($club)) {
            $this->clubs->add($club);
            $club->addEvenement($this);
        }

        return $this;
    }

    public function removeClub(Club $club): static
    {
        if ($this->clubs->removeElement($club)) {
            $club->removeEvenement($this);
        }

        return $this;
    }


    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): static
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes->add($equipe);
            $equipe->setEvenement($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): static
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getEvenement() === $this) {
                $equipe->setEvenement(null);
            }
        }

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getEvenements(): ?TypeEvenement
    {
        return $this->evenements;
    }

    public function setEvenements(?TypeEvenement $evenements): static
    {
        $this->evenements = $evenements;

        return $this;
    }
}
