<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * @ORM\Entity(repositoryClass="App\Repository\MaintenanceBateauRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class MaintenanceBateau
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("bateau:read")
     */
    private ?string $designation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $categorieMaintenance;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $fourniture;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("bateau:read")
     */
    private mixed $rythmebateau;

    /**
     * @return mixed
     */
    public function getRythmebateau(): mixed
    {
        return $this->rythmebateau;
    }

    /**
     * @param mixed $rythmebateau
     */
    public function setRythmebateau(mixed $rythmebateau): void
    {
        $this->rythmebateau = $rythmebateau;
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $faitle;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $echeance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\bateau", inversedBy="maintenanceBateaus")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?bateau $bateauMaintenuId;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
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

    public function getBateauMaintenuId(): ?bateau
    {
        return $this->bateauMaintenuId;
    }

    public function setBateauMaintenuId(?bateau $bateauMaintenuId): self
    {
        $this->bateauMaintenuId = $bateauMaintenuId;

        return $this;
    }
    /**
        * Met à jour l'echéance pour les opérations annuelles
        *
        * @ORM\PrePersist()
        * @ORM\PreUpdate()
        */
       public function initializeEcheance(): void
       {
           $fait = $this->getFaitle();

           if ($this->rythmebateau === 'Annuel' && $fait !== null) {
               $fait = date_format($fait, 'Y-m-d');
               $echeance = date('Y-m-d', strtotime('+1 year', strtotime($fait)));
               $date = date_create($echeance);
               $this->echeance = $date;
           } elseif ($this->rythmebateau === 'Souvent') {
               $this->echeance = null;
           }
       }
}
