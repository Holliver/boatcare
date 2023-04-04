<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaintenanceVoileRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MaintenanceVoile
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
    private $designation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $categorie_maintenance;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $fourniture;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $faitle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $echeance;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $rythme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voile", inversedBy="maintenanceVoiles")
     */
    private $voile;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
         * Met à jour l'échéance pour les opérations annuelles
         *
         * @ORM\PrePersist()
         * @ORM\PreUpdate()
         */
        public function initializeEcheance(): void
        {
            $fait = $this->getFaitle();

            if ($this->rythme === 'Annuel' && $fait !== null) {
                $fait = date_format($fait, 'Y-m-d');
                $echeance = date('Y-m-d', strtotime('+1 year', strtotime($fait)));
                $date = date_create($echeance);
                $this->echeance = $date;
            } elseif ($this->rythme === 'Souvent') {
                $this->echeance = null;
            }
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
        return $this->categorie_maintenance;
    }

    public function setCategorieMaintenance(string $categorie_maintenance): self
    {
        $this->categorie_maintenance = $categorie_maintenance;

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

    public function getEcheance(): ?\DateTimeInterface
    {
        return $this->echeance;
    }

    public function setEcheance(?\DateTimeInterface $echeance): self
    {
        $this->echeance = $echeance;

        return $this;
    }

    /**
     * @param $faitle
     * @return MaintenanceVoile
     */
    public function addOneYear($faitle): self
    {
        $this->echeance = $faitle['y'] + 1;
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

    public function getVoile(): ?Voile
    {
        return $this->voile;
    }

    public function setVoile(?Voile $voile): self
    {
        $this->voile = $voile;

        return $this;
    }
}
