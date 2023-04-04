<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdministrationRepository")
 */
class Administration
{
    /**
     * @ORM\Id()
     * * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private int|null $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $numFrancisation;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $numImatriculation;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $numLicenceStationNavire;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $indicatifAppel;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $cieAssurance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $emailCourtierAss;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $MMSI;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Bateau", inversedBy="administration", cascade={"persist", "remove"})
     */
    private $bateau;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MaintenanceAdministration", mappedBy="administration", orphanRemoval=true)
     * @Groups("bateau:read")
     */
    private $maintenanceAdministrations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DocAdministration", mappedBy="administration")
     */
    private $docAdministrations;




    public function __construct()
    {
        $this->maintenanceAdministrations = new ArrayCollection();
        $this->docAdministrations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumFrancisation(): ?string
    {
        return $this->numFrancisation;
    }

    public function setNumFrancisation(?string $numFrancisation): self
    {
        $this->numFrancisation = $numFrancisation;

        return $this;
    }

    public function getNumImatriculation(): ?string
    {
        return $this->numImatriculation;
    }

    public function setNumImatriculation(string $numImatriculation): self
    {
        $this->numImatriculation = $numImatriculation;

        return $this;
    }

    public function getNumLicenceStationNavire(): ?string
    {
        return $this->numLicenceStationNavire;
    }

    public function setNumLicenceStationNavire(?string $numLicenceStationNavire): self
    {
        $this->numLicenceStationNavire = $numLicenceStationNavire;

        return $this;
    }

    public function getIndicatifAppel(): ?string
    {
        return $this->indicatifAppel;
    }

    public function setIndicatifAppel(?string $indicatifAppel): self
    {
        $this->indicatifAppel = $indicatifAppel;

        return $this;
    }

    public function getCieAssurance(): ?string
    {
        return $this->cieAssurance;
    }

    public function setCieAssurance(?string $cieAssurance): self
    {
        $this->cieAssurance = $cieAssurance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmailCourtierAss(): ?string
    {
        return $this->emailCourtierAss;
    }

    /**
     * @param string|null $emailCourtierAss
     * @return Administration
     */
    public function setEmailCourtierAss(?string $emailCourtierAss): self
    {
        $this->emailCourtierAss = $emailCourtierAss;

        return $this;
    }

    public function getMMSI(): ?string
    {
        return $this->MMSI;
    }

    public function setMMSI(?string $MMSI): self
    {
        $this->MMSI = $MMSI;

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
     * @return Collection
     */
    public function getMaintenanceAdministrations(): Collection
    {
        return $this->maintenanceAdministrations;
    }

    public function addMaintenanceAdministration(MaintenanceAdministration $maintenanceAdministration): self
    {
        if (!$this->maintenanceAdministrations->contains($maintenanceAdministration)) {
            $this->maintenanceAdministrations[] = $maintenanceAdministration;
            $maintenanceAdministration->setAdministration($this);
        }

        return $this;
    }

    public function removeMaintenanceAdministration(MaintenanceAdministration $maintenanceAdministration): self
    {
        if ($this->maintenanceAdministrations->contains($maintenanceAdministration)) {
            $this->maintenanceAdministrations->removeElement($maintenanceAdministration);
            // set the owning side to null (unless already changed)
            if ($maintenanceAdministration->getAdministration() === $this) {
                $maintenanceAdministration->setAdministration(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DocAdministration[]
     */
    public function getDocAdministrations(): Collection
    {
        return $this->docAdministrations;
    }



   /* public function __toString() {
        return $this->numFrancisation;
    }*/


}
