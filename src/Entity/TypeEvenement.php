<?php

namespace App\Entity;

use App\Repository\TypeEvenementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeEvenementRepository::class)]
class TypeEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?bool $pour_tous = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_even = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

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

    public function isPourTous(): ?bool
    {
        return $this->pour_tous;
    }

    public function setPourTous(bool $pour_tous): static
    {
        $this->pour_tous = $pour_tous;

        return $this;
    }

    public function getDateEven(): ?\DateTimeInterface
    {
        return $this->date_even;
    }

    public function setDateEven(\DateTimeInterface $date_even): static
    {
        $this->date_even = $date_even;

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
}
