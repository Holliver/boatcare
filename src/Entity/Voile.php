<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoileRepository")
 */
class Voile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $denomination;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surface;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $anneeFabrication;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longueurGuindant;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longueurChute;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longueurBordure;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bateau", inversedBy="voiles")
     */
    private $bateau;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MaintenanceVoile", mappedBy="voile", orphanRemoval=true)
     */
    private $maintenanceVoiles;

    public function __construct()
    {
        $this->maintenanceVoiles = new ArrayCollection();
        $this->anneeAchat = 2020;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getAnneeFabrication(): ?int
    {
        return $this->anneeFabrication;
    }

    public function setAnneeFabrication(?int $anneeFabrication): self
    {
        $this->anneeFabrication = $anneeFabrication;

        return $this;
    }

    public function getLongueurGuindant(): ?float
    {
        return $this->longueurGuindant;
    }

    public function setLongueurGuindant(?float $longueurGuindant): self
    {
        $this->longueurGuindant = $longueurGuindant;

        return $this;
    }

    public function getLongueurChute(): ?float
    {
        return $this->longueurChute;
    }

    public function setLongueurChute(?float $longueurChute): self
    {
        $this->longueurChute = $longueurChute;

        return $this;
    }

    public function getLongueurBordure(): ?float
    {
        return $this->longueurBordure;
    }

    public function setLongueurBordure(?float $longueurBordure): self
    {
        $this->longueurBordure = $longueurBordure;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(?string $matiere): self
    {
        $this->matiere = $matiere;

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
     * @return Collection|MaintenanceVoile[]
     */
    public function getMaintenanceVoiles(): Collection
    {
        return $this->maintenanceVoiles;
    }

    public function addMaintenanceVoile(MaintenanceVoile $maintenanceVoile): self
    {
        if (!$this->maintenanceVoiles->contains($maintenanceVoile)) {
            $this->maintenanceVoiles[] = $maintenanceVoile;
            $maintenanceVoile->setVoile($this);
        }

        return $this;
    }

    public function removeMaintenanceVoile(MaintenanceVoile $maintenanceVoile): self
    {
        if ($this->maintenanceVoiles->contains($maintenanceVoile)) {
            $this->maintenanceVoiles->removeElement($maintenanceVoile);
            // set the owning side to null (unless already changed)
            if ($maintenanceVoile->getVoile() === $this) {
                $maintenanceVoile->setVoile(null);
            }
        }

        return $this;
    }
}
