<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoteurRepository")
 */
class Moteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("bateau:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("bateau:read")
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private $modele;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private $puissance;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private $num_serie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private $annee_achat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bateau:read")
     */
    private $type_moteur;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups("bateau:read")
     */
    private $carburant;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private $transmission;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MaintenanceMoteur", mappedBy="moteur_id")
     * @Groups("bateau:read")
     */
    private $maintenanceMoteurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bateau", inversedBy="moteurs")
     */
    private $bateau;

    /**
     * @ORM\OneToMany(targetEntity=DocMoteur::class, mappedBy="moteur")
     */
    private $docMoteurs;



    public function __construct()
    {
        $this->maintenanceMoteurs = new ArrayCollection();
        $this->docs = new ArrayCollection();
        $this->docMoteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(?int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getNumSerie(): ?string
    {
        return $this->num_serie;
    }

    public function setNumSerie(?string $num_serie): self
    {
        $this->num_serie = $num_serie;

        return $this;
    }

    public function getAnneeAchat(): ?int
    {
        return $this->annee_achat;
    }

    public function setAnneeAchat(?int $annee_achat): self
    {
        $this->annee_achat = $annee_achat;

        return $this;
    }

    public function getTypeMoteur(): ?string
    {
        return $this->type_moteur;
    }

    public function setTypeMoteur(?string $type_moteur): self
    {
        $this->type_moteur = $type_moteur;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(?string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(?string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    /**
     * @return Collection|MaintenanceMoteur[]
     */
    public function getMaintenanceMoteurs(): Collection
    {
        return $this->maintenanceMoteurs;
    }

    public function addMaintenanceMoteur(MaintenanceMoteur $maintenanceMoteur): self
    {
        if (!$this->maintenanceMoteurs->contains($maintenanceMoteur)) {
            $this->maintenanceMoteurs[] = $maintenanceMoteur;
            $maintenanceMoteur->setMoteurId($this);
        }

        return $this;
    }

    public function removeMaintenanceMoteur(MaintenanceMoteur $maintenanceMoteur): self
    {
        if ($this->maintenanceMoteurs->contains($maintenanceMoteur)) {
            $this->maintenanceMoteurs->removeElement($maintenanceMoteur);
            // set the owning side to null (unless already changed)
            if ($maintenanceMoteur->getMoteurId() === $this) {
                $maintenanceMoteur->setMoteurId(null);
            }
        }

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
     * @return Collection|DocMoteur[]
     */
    public function getDocMoteurs(): Collection
    {
        return $this->docMoteurs;
    }

    public function addDocMoteur(DocMoteur $docMoteur): self
    {
        if (!$this->docMoteurs->contains($docMoteur)) {
            $this->docMoteurs[] = $docMoteur;
            $docMoteur->setMoteur($this);
        }

        return $this;
    }

    public function removeDocMoteur(DocMoteur $docMoteur): self
    {
        if ($this->docMoteurs->contains($docMoteur)) {
            $this->docMoteurs->removeElement($docMoteur);
            // set the owning side to null (unless already changed)
            if ($docMoteur->getMoteur() === $this) {
                $docMoteur->setMoteur(null);
            }
        }

        return $this;
    }
}
