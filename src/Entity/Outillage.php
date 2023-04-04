<?php

namespace App\Entity;

use App\Repository\OutillageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OutillageRepository::class)
 */
class Outillage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("bateau:read")
     */
    private ?string $designation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $marque;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $modele;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private int $quantite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private int $anneeAchat;

    /**
     * @ORM\ManyToOne(targetEntity=Bateau::class, inversedBy="outillages")
     */
    private ?Bateau $bateau;

    /**
     * @ORM\OneToMany(targetEntity=MaintenanceOutillage::class, mappedBy="outillage")
     * @Groups("bateau:read")
     */
    private mixed $maintenanceOutillages;

    /**
     * @ORM\OneToMany(targetEntity=DocOutillage::class, mappedBy="outillage")
     */
    private $docOutillages;

    public function __construct()
    {

        $this->quantite = 1;
        $this->annee_achat = 2020;
        $this->docOutillages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    /**
     * @return mixed
     */
    public function getMaintenanceOutillages()
    {
        return $this->maintenanceOutillages;
    }

    /**
     * @param mixed $maintenanceOutillages
     */
    public function setMaintenanceOutillages(mixed $maintenanceOutillages): void
    {
        $this->maintenanceOutillages = $maintenanceOutillages;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getAnneeAchat(): ?int
    {
        return $this->anneeAchat;
    }

    public function setAnneeAchat(?int $annee_achat): self
    {
        $this->annee_achat = $annee_achat;

        return $this;
    }

    public function getBateau(): ?Bateau
    {
        return $this->bateau;
    }

    public function setBateau(?Bateau $bateau): self
    {
        $this->bateau = $bateau;

        return $this;
    }

    /**
     * @return Collection<int, DocOutillage>
     */
    public function getDocOutillages(): Collection
    {
        return $this->docOutillages;
    }

    public function addDocOutillage(DocOutillage $docOutillage): self
    {
        if (!$this->docOutillages->contains($docOutillage)) {
            $this->docOutillages[] = $docOutillage;
            $docOutillage->setOutillage($this);
        }

        return $this;
    }

    public function removeDocOutillage(DocOutillage $docOutillage): self
    {
        // set the owning side to null (unless already changed)
        if ($this->docOutillages->removeElement($docOutillage) && $docOutillage->getOutillage() === $this) {
            $docOutillage->setOutillage(null);
        }

        return $this;
    }
}
