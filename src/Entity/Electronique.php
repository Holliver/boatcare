<?php

namespace App\Entity;

use App\Repository\ElectroniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ElectroniqueRepository::class)
 */
class Electronique
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
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity=Bateau::class, inversedBy="electroniques")
     */
    private $bateau;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bateau:read")
     */
    private $modele;

    /**
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private $anneeAchat;

    /**
     * @ORM\OneToMany(targetEntity=MaintenanceElectronique::class, mappedBy="electronique")
     * @Groups("bateau:read")
     */
    private $maintenanceElectroniques;

    /**
     * @ORM\OneToMany(targetEntity=DocElectronique::class, mappedBy="electronique")
     */
    private $docElectroniques;



    public function __construct()
    {
        $this->maintenanceElectroniques = new ArrayCollection();
        $this->docElectroniques = new ArrayCollection();
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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

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

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection|MaintenanceElectronique[]
     */
    public function getMaintenanceElectroniques(): Collection
    {
        return $this->maintenanceElectroniques;
    }

    public function addMaintenanceElectronique(MaintenanceElectronique $maintenanceElectronique): self
    {
        if (!$this->maintenanceElectroniques->contains($maintenanceElectronique)) {
            $this->maintenanceElectroniques[] = $maintenanceElectronique;
            $maintenanceElectronique->setElectronique($this);
        }

        return $this;
    }

    public function removeMaintenanceElectronique(MaintenanceElectronique $maintenanceElectronique): self
    {
        if ($this->maintenanceElectroniques->contains($maintenanceElectronique)) {
            $this->maintenanceElectroniques->removeElement($maintenanceElectronique);
            // set the owning side to null (unless already changed)
            if ($maintenanceElectronique->getElectronique() === $this) {
                $maintenanceElectronique->setElectronique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DocElectronique[]
     */
    public function getDocElectroniques(): Collection
    {
        return $this->docElectroniques;
    }

    public function addDocElectronique(DocElectronique $docElectronique): self
    {
        if (!$this->docElectroniques->contains($docElectronique)) {
            $this->docElectroniques[] = $docElectronique;
            $docElectronique->setElectronique($this);
        }

        return $this;
    }

    public function removeDocElectronique(DocElectronique $docElectronique): self
    {
        if ($this->docElectroniques->contains($docElectronique)) {
            $this->docElectroniques->removeElement($docElectronique);
            // set the owning side to null (unless already changed)
            if ($docElectronique->getElectronique() === $this) {
                $docElectronique->setElectronique(null);
            }
        }

        return $this;
    }

    public function getAnneeAchat(): ?int
    {
        return $this->anneeAchat;
    }

    public function setAnneeAchat(int $anneeAchat): self
    {
        $this->anneeAchat = $anneeAchat;

        return $this;
    }
}
