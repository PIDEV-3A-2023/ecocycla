<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $descriptionB = null;

    #[ORM\Column(length: 255)]
    private ?string $imageB = null;

    #[ORM\ManyToOne]
    private ?User $idut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getDescriptionB(): ?string
    {
        return $this->descriptionB;
    }

    public function setDescriptionB(string $descriptionB): self
    {
        $this->descriptionB = $descriptionB;

        return $this;
    }

    public function getImageB(): ?string
    {
        return $this->imageB;
    }

    public function setImageB(string $imageB): self
    {
        $this->imageB = $imageB;

        return $this;
    }

    public function getIdut(): ?User
    {
        return $this->idut;
    }

    public function setIdut(?User $idut): self
    {
        $this->idut = $idut;

        return $this;
    }
}
