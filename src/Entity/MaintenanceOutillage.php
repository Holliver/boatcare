<?php

namespace App\Entity;

use App\Entity\Repository\MaintenanceOutillageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OutillageRepository::class)
 */
class MaintenanceOutillage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private mixed $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private mixed $designation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private mixed $categorieMaintenance;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private mixed $fourniture;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private mixed $faitle;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private mixed $rythme;

    /**
     * @return mixed
     */
    public function getCategorieMaintenance(): mixed
    {
        return $this->categorieMaintenance;
    }

    /**
     * @param mixed $categorieMaintenance
     */
    public function setCategorieMaintenance(mixed $categorieMaintenance): void
    {
        $this->categorieMaintenance = $categorieMaintenance;
    }

    /**
     * @return mixed
     */
    public function getFourniture(): mixed
    {
        return $this->fourniture;
    }

    /**
     * @param mixed $fourniture
     */
    public function setFourniture(mixed $fourniture): void
    {
        $this->fourniture = $fourniture;
    }

    /**
     * @return mixed
     */
    public function getFaitle(): mixed
    {
        return $this->faitle;
    }

    /**
     * @param mixed $faitle
     */
    public function setFaitle(mixed $faitle): void
    {
        $this->faitle = $faitle;
    }

    /**
     * @return mixed
     */
    public function getRythme(): mixed
    {
        return $this->rythme;
    }

    /**
     * @param mixed $rythme
     */
    public function setRythme(mixed $rythme): void
    {
        $this->rythme = $rythme;
    }

    /**
     * @return mixed
     */
    public function getEcheance(): mixed
    {
        return $this->echeance;
    }

    /**
     * @param mixed $echeance
     */
    public function setEcheance($echeance): void
    {
        $this->echeance = $echeance;
    }

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private mixed $echeance;

    /**
     * @ORM\ManyToOne(targetEntity=Outillage::class, inversedBy="maintenanceOutillages")
     */
    private mixed $outillage;

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDesignation(): mixed
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation(mixed $designation): void
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getOutillage(): mixed
    {
        return $this->outillage;
    }

    /**
     * @param mixed $outillage
     */
    public function setOutillage(mixed $outillage): void
    {
        $this->outillage = $outillage;
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

        if ($this->rythme === 'Annuelle' && $fait !== null) {
            $fait = date_format($fait, 'Y-m-d');
            $echeance = date('Y-m-d', strtotime('+1 year', strtotime($fait)));
            $date = date_create($echeance);
            $this->echeance = $date;
        }
    }


}
