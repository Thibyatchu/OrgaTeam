<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Equipe>
     */
    #[ORM\OneToMany(targetEntity: Equipe::class, mappedBy: 'categorie')]
    private Collection $equipes;

    #[ORM\Column]
    private ?int $nombre_equipe = null;

    #[ORM\Column]
    private ?int $effectif_joueur = null;

    public function __construct()
    {
        $this->equipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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
            $equipe->setCategorie($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): static
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getCategorie() === $this) {
                $equipe->setCategorie(null);
            }
        }

        return $this;
    }

    public function getNombreEquipe(): ?int
    {
        return $this->nombre_equipe;
    }

    public function setNombreEquipe(int $nombre_equipe): static
    {
        $this->nombre_equipe = $nombre_equipe;

        return $this;
    }

    public function getEffectifJoueur(): ?int
    {
        return $this->effectif_joueur;
    }

    public function setEffectifJoueur(int $effectif_joueur): static
    {
        $this->effectif_joueur = $effectif_joueur;

        return $this;
    }
}
