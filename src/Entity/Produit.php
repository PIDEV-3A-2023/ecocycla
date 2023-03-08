<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomP = null;

    #[ORM\Column]
    private ?float $prixP = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionP = null;

    #[ORM\Column(length: 255)]
    private ?string $imageP = null;

    #[ORM\Column(nullable: true)]
    private ?int $stock = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantiteproduit = null;
    #[ORM\Column(length: 255)]
    private ?string $imageQrCode = null;

    #[ORM\ManyToOne]
    private ?User $iduserproduit = null;



    #[ORM\ManyToOne]
    private ?CategorieP $idcatP = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomP(): ?string
    {
        return $this->nomP;
    }

    public function setNomP(string $nomP): self
    {
        $this->nomP = $nomP;

        return $this;
    }

    public function getPrixP(): ?float
    {
        return $this->prixP;
    }

    public function setPrixP(float $prixP): self
    {
        $this->prixP = $prixP;

        return $this;
    }

    public function getDescriptionP(): ?string
    {
        return $this->descriptionP;
    }

    public function setDescriptionP(string $descriptionP): self
    {
        $this->descriptionP = $descriptionP;

        return $this;
    }

    public function getImageP(): ?string
    {
        return $this->imageP;
    }

    public function setImageP(string $imageP): self
    {
        $this->imageP = $imageP;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getQuantiteproduit(): ?int
    {
        return $this->quantiteproduit;
    }

    public function setQuantiteproduit(?int $quantiteproduit): self
    {
        $this->quantiteproduit = $quantiteproduit;

        return $this;
    }

    public function getIduserproduit(): ?User
    {
        return $this->iduserproduit;
    }

    public function setIduserproduit(?User $iduserproduit): self
    {
        $this->iduserproduit = $iduserproduit;

        return $this;
    }



    public function getIdcatP(): ?CategorieP
    {
        return $this->idcatP;
    }

    public function setIdcatP(?CategorieP $idcatP): self
    {
        $this->idcatP = $idcatP;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getImageQrCode(): ?string
    {
        return $this->imageQrCode;
    }

    /**
     * @param string|null $imageQrCode
     */
    public function setImageQrCode(?string $imageQrCode): void
    {
        $this->imageQrCode = $imageQrCode;
    }
}
