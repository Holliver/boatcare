<?php

namespace App\Entity;

use App\Repository\MaintenanceAccastillageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MaintenanceAccastillageRepository::class)
 */
class MaintenanceAccastillage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *  @Groups("bateau:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *  @Groups("bateau:read")
     */
    private $categorieMaintenance;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("bateau:read")
     */
    private $designation;

    /**
     * @ORM\Column(type="text", nullable=true)
     *  @Groups("bateau:read")
     */
    private $fourniture;

    /**
     * @ORM\Column(type="date", nullable=true)
     *  @Groups("bateau:read")
     */
    private $faitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     *  @Groups("bateau:read")
     */
    private $rythme;

    /**
     * @ORM\Column(type="date", nullable=true)
     *  @Groups("bateau:read")
     */
    private $echeance;

    /**
     * @ORM\ManyToOne(targetEntity=Accastillage::class, inversedBy="maintenanceAccastillages")
     */
    private $accastillage;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

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

    public function setRythme(string $rythme): self
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

    public function getAccastillage(): ?Accastillage
    {
        return $this->accastillage;
    }

    public function setAccastillage(?Accastillage $accastillage): self
    {
        $this->accastillage = $accastillage;

        return $this;
    }
}
