<?php

namespace App\Entity;

use App\Repository\AccastillageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AccastillageRepository::class)
 */
class Accastillage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("bateau:read")
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private $modele;

    /**
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private $anneeAchat;

    /**
     * @ORM\ManyToOne(targetEntity=Bateau::class, inversedBy="accastillages")
     */
    private $bateau;

    /**
     * @ORM\OneToMany(targetEntity=MaintenanceAccastillage::class, mappedBy="accastillage")
     * @Groups("bateau:read")
     */
    private $maintenanceAccastillages;



    public function __construct()
    {
        $this->maintenanceAccastillages = new ArrayCollection();
        $this->quantite = 1;
        $this->anneeAchat = 2020;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getAnneeAchat(): ?int
    {
        return $this->anneeAchat;
    }

    public function setAnneeAchat(?int $anneeAchat): self
    {
        $this->anneeAchat = $anneeAchat;

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
     * @return Collection|MaintenanceAccastillage[]
     */
    public function getMaintenanceAccastillages(): Collection
    {
        return $this->maintenanceAccastillages;
    }

    public function addMaintenanceAccastillage(MaintenanceAccastillage $maintenanceAccastillage): self
    {
        if (!$this->maintenanceAccastillages->contains($maintenanceAccastillage)) {
            $this->maintenanceAccastillages[] = $maintenanceAccastillage;
            $maintenanceAccastillage->setAccastillage($this);
        }

        return $this;
    }

    public function removeMaintenanceAccastillage(MaintenanceAccastillage $maintenanceAccastillage): self
    {
        if ($this->maintenanceAccastillages->contains($maintenanceAccastillage)) {
            $this->maintenanceAccastillages->removeElement($maintenanceAccastillage);
            // set the owning side to null (unless already changed)
            if ($maintenanceAccastillage->getAccastillage() === $this) {
                $maintenanceAccastillage->setAccastillage(null);
            }
        }

        return $this;
    }
}
