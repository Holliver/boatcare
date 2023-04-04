<?php

namespace App\Entity;

use App\Repository\MaintenanceElectroniqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaintenanceElectroniqueRepository::class)
 */
class MaintenanceElectronique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $designation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $categorieMaintenance;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fourniture;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $faitle;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $rythme;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $echeance;

    /**
     * @ORM\ManyToOne(targetEntity=Electronique::class, inversedBy="maintenanceElectroniques")
     */
    private $electronique;

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

    public function getCategorieMaintenance(): ?string
    {
        return $this->categorieMaintenance;
    }

    public function setCategorieMaintenance(?string $categorieMaintenance): self
    {
        $this->categorieMaintenance = $categorieMaintenance;

        return $this;
    }

    public function getFourniture(): ?string
    {
        return $this->fourniture;
    }

    public function setFourniture(?string $fourniture): self
    {
        $this->fourniture = $fourniture;

        return $this;
    }

    public function getFaitle(): ?\DateTimeInterface
    {
        return $this->faitle;
    }

    public function setFaitle(?\DateTimeInterface $faitle): self
    {
        $this->faitle = $faitle;

        return $this;
    }

    public function getRythme(): ?string
    {
        return $this->rythme;
    }

    public function setRythme(?string $rythme): self
    {
        $this->rythme = $rythme;

        return $this;
    }

    public function getEcheance(): ?\DateTimeInterface
    {
        return $this->echeance;
    }

    public function setEcheance(?\DateTimeInterface $echeance): self
    {
        $this->echeance = $echeance;

        return $this;
    }

    public function getElectronique(): ?Electronique
    {
        return $this->electronique;
    }

    public function setElectronique(?Electronique $electronique): self
    {
        $this->electronique = $electronique;

        return $this;
    }
}
