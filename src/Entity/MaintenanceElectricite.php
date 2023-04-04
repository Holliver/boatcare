<?php

namespace App\Entity;

use App\Repository\MaintenanceElectriciteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaintenanceElectriciteRepository::class)
 */
class MaintenanceElectricite
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
     * @return mixed
     */
    public function getCategorieMaintenance()
    {
        return $this->categorieMaintenance;
    }

    /**
     * @param mixed $categorieMaintenance
     */
    public function setCategorieMaintenance($categorieMaintenance): void
    {
        $this->categorieMaintenance = $categorieMaintenance;
    }

    /**
     * @return mixed
     */
    public function getFourniture()
    {
        return $this->fourniture;
    }

    /**
     * @param mixed $fourniture
     */
    public function setFourniture($fourniture): void
    {
        $this->fourniture = $fourniture;
    }

    /**
     * @return mixed
     */
    public function getFaitle()
    {
        return $this->faitle;
    }

    /**
     * @param mixed $faitle
     */
    public function setFaitle($faitle): void
    {
        $this->faitle = $faitle;
    }

    /**
     * @return mixed
     */
    public function getRythme()
    {
        return $this->rythme;
    }

    /**
     * @param mixed $rythme
     */
    public function setRythme($rythme): void
    {
        $this->rythme = $rythme;
    }

    /**
     * @return mixed
     */
    public function getEcheance()
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
    private $echeance;

    /**
     * @ORM\ManyToOne(targetEntity=Electricite::class, inversedBy="maintenanceElectricites")
     */
    private $electricite;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation): void
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getElectricite()
    {
        return $this->electricite;
    }

    /**
     * @param mixed $electricite
     */
    public function setElectricite($electricite): void
    {
        $this->electricite = $electricite;
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
