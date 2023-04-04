<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MaintenanceMoteurRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MaintenanceMoteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Moteur", inversedBy="maintenanceMoteurs")
     *
     */
    private $moteur_id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("bateau:read")
     *
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("bateau:read")
     */
    private $categorie_maintenance;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("bateau:read")
     */
    private $fourniture;


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
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups("bateau:read")
     */
    private $rythme;

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

        if ($this->rythme === 'Annuelle' && $fait !== null) {
            $fait = date_format($fait, 'Y-m-d');
            $echeance = date('Y-m-d', strtotime('+1 year', strtotime($fait)));
            $date = date_create($echeance);
            $this->echeance = $date;
        }
    }

    public function getMoteurId(): ?Moteur
    {
        return $this->moteur_id;
    }

    public function setMoteurId(?Moteur $moteur_id): self
    {
        $this->moteur_id = $moteur_id;

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
     * @param $moteur
     */
    public function setMoteur($moteur)
    {
    }

    /**
     * @param $faitle
     * @return MaintenanceMoteur
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

}
