<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaintenanceAdministrationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MaintenanceAdministration
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
     * @ORM\Column(type="string", length=100)
     * @Groups("bateau:read")
     */
    private $categorie_maintenance;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("bateau:read")
     */
    private $rythmeadministration;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("bateau:read")
     */
    private $faitle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("bateau:read")
     */
    private $echeance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Administration", inversedBy="maintenanceAdministrations")
     */
    private $administration;

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

        if ($this->rythmeadministration === 'Annuelle' && $fait !== null) {
            $fait = date_format($fait, 'Y-m-d');
            $echeance = date('Y-m-d', strtotime('+1 year', strtotime($fait)));
            $date = date_create($echeance);
            $this->echeance = $date;
        }
    }

    /**
     * @return mixed
     */
    public function getAdministration(): mixed
    {
        return $this->administration;
    }

    /**
     * @param mixed $administration
     */
    public function setAdministration(mixed $administration): void
    {
        $this->administration = $administration;
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

    /**
     * @return mixed
     */
    public function getRythmeadministration(): mixed
    {
        return $this->rythmeadministration;
    }

    /**
     * @param mixed $rythmeadministration
     */
    public function setRythmeadministration(mixed $rythmeadministration): void
    {
        $this->rythmeadministration = $rythmeadministration;
    }



    public function getFaitle(): ?DateTimeInterface
    {
        return $this->faitle;
    }

    public function setFaitle(?DateTimeInterface $faitle): self
    {
        $this->faitle = $faitle;

        return $this;
    }

    public function getEcheance(): ?DateTimeInterface
    {
        return $this->echeance;
    }

    public function setEcheance(?DateTimeInterface $echeance): self
    {
        $this->echeance = $echeance;

        return $this;
    }

}
