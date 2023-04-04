<?php

namespace App\Entity;

use App\Repository\ElectriciteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ElectriciteRepository::class)
 */
class Electricite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Bateau::class, inversedBy="electricites")
     */
    private ?Bateau $bateau;

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
    private $quantite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private $anneeAchat;

    /**
     * @ORM\OneToMany(targetEntity=DocElectricite::class, mappedBy="electricite")
     */
    private $docElectricites;

    /**
     * @ORM\OneToMany(targetEntity=MaintenanceElectricite::class, mappedBy="electricite")
     */
    private $maintenanceElectricites;

    public function __construct()
    {
        $this->docElectricites = new ArrayCollection();
        $this->maintenanceElectricites = new ArrayCollection();
        $this->quantite = 1;
        $this->anneeAchat = 2020;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $anneeAchat
     */
    public function setAnneeAchat($anneeAchat): void
    {
        $this->anneeAchat = $anneeAchat;
    }

    /**
     * @param ArrayCollection $docElectricites
     */
    public function setDocElectricites(ArrayCollection $docElectricites): void
    {
        $this->docElectricites = $docElectricites;
    }

    /**
     * @param ArrayCollection $maintenanceElectricites
     */
    public function setMaintenanceElectricites(ArrayCollection $maintenanceElectricites): void
    {
        $this->maintenanceElectricites = $maintenanceElectricites;
    }



    /**
     * @return Collection|DocElectricite[]
     */
    public function getDocElectricites(): Collection
    {
        return $this->docElectricites;
    }

    public function addDocElectricite(DocElectricite $docElectricite): self
    {
        if (!$this->docElectricites->contains($docElectricite)) {
            $this->docElectricites[] = $docElectricite;
            $docElectricite->setElectricite($this);
        }

        return $this;
    }

    public function removeDocElectricite(DocElectricite $docElectricite): self
    {
        if ($this->docElectricites->contains($docElectricite)) {
            $this->docElectricites->removeElement($docElectricite);
            // set the owning side to null (unless already changed)
            if ($docElectricite->getElectricite() === $this) {
                $docElectricite->setElectricite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MaintenanceElectricite[]
     */
    public function getMaintenanceElectricites(): Collection
    {
        return $this->maintenanceElectricites;
    }

    public function addMaintenanceElectricite(MaintenanceElectricite $maintenanceElectricite): self
    {
        if (!$this->maintenanceElectricites->contains($maintenanceElectricite)) {
            $this->maintenanceElectricites[] = $maintenanceElectricite;
            $maintenanceElectricite->setElectricite($this);
        }

        return $this;
    }

    public function removeMaintenanceElectricite(MaintenanceElectricite $maintenanceElectricite): self
    {
        if ($this->maintenanceElectricites->contains($maintenanceElectricite)) {
            $this->maintenanceElectricites->removeElement($maintenanceElectricite);
            // set the owning side to null (unless already changed)
            if ($maintenanceElectricite->getElectricite() === $this) {
                $maintenanceElectricite->setElectricite(null);
            }
        }

        return $this;
    }
}
