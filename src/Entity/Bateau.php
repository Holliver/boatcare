<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BateauRepository")
 */
class Bateau
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
    private ?string $nom;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("bateau:read")
     */
    private ?float $longueur;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("bateau:read")
     */
    private ?float $largeur;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("bateau:read")
     */
    private ?float $tirantdeau;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("bateau:read")
     */
    private ?string $constructeur;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $modele;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $annee_construction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bateaus")
     */
    private ?User $user_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private ?int $poids;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("bateau:read")
     */
    private ?float $tirant_dair;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private ?int $fuel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("bateau:read")
     */
    private ?int $eau;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MaintenanceBateau", mappedBy="bateauMaintenuId")
     * @Groups("bateau:read")
     */
    private $maintenanceBateaus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Moteur", mappedBy="bateau")
     * @Groups("bateau:read")
     */
    private  $moteurs;



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Administration", mappedBy="bateau", cascade={"persist", "remove"})
     * @Groups("bateau:read")
     */
    private  $administration;




    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Voile", mappedBy="bateau")
     */
    private $voiles;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private ?string $categorieConception;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $typeNavigation;



    /**
     * @ORM\OneToMany(targetEntity=Electronique::class, mappedBy="bateau")
     * @Groups("bateau:read")
     */
    private  $electroniques;

    /**
     * @ORM\OneToMany(targetEntity=MaterielSecuriteLegal::class, mappedBy="bateau")
     * @Groups("bateau:read")
     */
    private  $materielSecuriteLegals;

    /**
     * @ORM\OneToMany(targetEntity=Electricite::class, mappedBy="bateau")
     * @Groups("bateau:read")
     */
    private  $electricites;

    /**
     * @ORM\OneToMany(targetEntity=Accastillage::class, mappedBy="bateau")
     * @Groups("bateau:read")
     */
    private  $accastillages;

    /**
     * @ORM\OneToMany(targetEntity=Outillage::class, mappedBy="bateau")
     * @Groups("bateau:read")
     */
    private $outillages;

/*    public function __toString() {
        return $this->nom;
    }*/



    public function __construct()
    {
        $this->moteurs = new ArrayCollection();
        $this->maintenanceBateaus = new ArrayCollection();
        $this->voiles = new ArrayCollection();
        $this->administration = new ArrayCollection();
        $this->electroniques = new ArrayCollection();
        $this->materielSecuriteLegals = new ArrayCollection();
        $this->electricites = new ArrayCollection();
        $this->accastillages = new ArrayCollection();
        $this->annee_construction = 2020;
        $this->outillages = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLongueur(): ?float
    {
        return $this->longueur;
    }

    public function setLongueur(?float $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?float
    {
        return $this->largeur;
    }

    public function setLargeur(?float $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getTirantdeau(): ?float
    {
        return $this->tirantdeau;
    }

    public function setTirantdeau(?float $tirantdeau): self
    {
        $this->tirantdeau = $tirantdeau;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getConstructeur(): ?string
    {
        return $this->constructeur;
    }

    public function setConstructeur(?string $constructeur): self
    {
        $this->constructeur = $constructeur;

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

    public function getAnneeConstruction(): ?int
    {
        return $this->annee_construction;
    }

    public function setAnneeConstruction(?int $annee_construction): self
    {
        $this->annee_construction = $annee_construction;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(?int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getTirantDair(): ?float
    {
        return $this->tirant_dair;
    }

    public function setTirantDair(?float $tirant_dair): self
    {
        $this->tirant_dair = $tirant_dair;

        return $this;
    }

    public function getFuel(): ?int
    {
        return $this->fuel;
    }

    public function setFuel(?int $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getEau(): ?int
    {
        return $this->eau;
    }

    public function setEau(?int $eau): self
    {
        $this->eau = $eau;

        return $this;
    }

    public function setUser($getUser)
    {
    }

    /**
     * @return Collection|Moteur[]
     */
    public function getMoteurs(): Collection
    {
        return $this->moteurs;
    }

    public function addMoteur(Moteur $moteur): self
    {
        if (!$this->moteurs->contains($moteur)) {
            $this->moteurs[] = $moteur;
            $moteur->setBateau($this);
        }

        return $this;
    }

    public function removeMoteur(Moteur $moteur): self
    {
        if ($this->moteurs->contains($moteur)) {
            $this->moteurs->removeElement($moteur);
            // set the owning side to null (unless already changed)
            if ($moteur->getBateau() === $this) {
                $moteur->setBateau(null);
            }
        }

        return $this;
    }


    public function getAdministration(): ?Administration
    {
        return $this->administration;
    }

    public function setAdministration(?Administration $administration): self
    {
        $this->administration = $administration;

        // set (or unset) the owning side of the relation if necessary
        $newBateau = $administration === null ? null : $this;
        if ($newBateau !== $administration->getBateau()) {
            $administration->setBateau($newBateau);
        }

        return $this;
    }





    /**
     * @return Collection|MaintenanceBateau[]
     */
    public function getMaintenanceBateaus(): Collection
    {
        return $this->maintenanceBateaus;
    }

    public function addMaintenanceBateau(MaintenanceBateau $maintenanceBateau): self
    {
        if (!$this->maintenanceBateaus->contains($maintenanceBateau)) {
            $this->maintenanceBateaus[] = $maintenanceBateau;
            $maintenanceBateau->setBateauMaintenuId($this);
        }

        return $this;
    }

    public function removeMaintenanceBateau(MaintenanceBateau $maintenanceBateau): self
    {
        if ($this->maintenanceBateaus->contains($maintenanceBateau)) {
            $this->maintenanceBateaus->removeElement($maintenanceBateau);
            // set the owning side to null (unless already changed)
            if ($maintenanceBateau->getBateauMaintenuId() === $this) {
                $maintenanceBateau->setBateauMaintenuId(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection|Voile[]
     */
    public function getVoiles(): Collection
    {
        return $this->voiles;
    }

    public function addVoile(Voile $voile): self
    {
        if (!$this->voiles->contains($voile)) {
            $this->voiles[] = $voile;
            $voile->setBateau($this);
        }

        return $this;
    }

    public function removeVoile(Voile $voile): self
    {
        if ($this->voiles->contains($voile)) {
            $this->voiles->removeElement($voile);
            // set the owning side to null (unless already changed)
            if ($voile->getBateau() === $this) {
                $voile->setBateau(null);
            }
        }

        return $this;
    }



    public function getCategorieConception(): ?string
    {
        return $this->categorieConception;
    }

    public function setCategorieConception(?string $categorieConception): self
    {
        $this->categorieConception = $categorieConception;

        return $this;
    }

    public function getTypeNavigation(): ?string
    {
        return $this->typeNavigation;
    }

    public function setTypeNavigation(?string $typeNavigation): self
    {
        $this->typeNavigation = $typeNavigation;

        return $this;
    }

    /**
     * @return Collection|Electronique[]
     */
    public function getElectroniques(): Collection
    {
        return $this->electroniques;
    }

    public function addElectronique(Electronique $electronique): self
    {
        if (!$this->electroniques->contains($electronique)) {
            $this->electroniques[] = $electronique;
            $electronique->setBateau($this);
        }

        return $this;
    }

    public function removeElectronique(Electronique $electronique): self
    {
        if ($this->electroniques->contains($electronique)) {
            $this->electroniques->removeElement($electronique);
            // set the owning side to null (unless already changed)
            if ($electronique->getBateau() === $this) {
                $electronique->setBateau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MaterielSecuriteLegal[]
     */
    public function getMaterielSecuriteLegals(): Collection
    {
        return $this->materielSecuriteLegals;
    }

    public function addMaterielSecuriteLegal(MaterielSecuriteLegal $materielSecuriteLegal): self
    {
        if (!$this->materielSecuriteLegals->contains($materielSecuriteLegal)) {
            $this->materielSecuriteLegals[] = $materielSecuriteLegal;
            $materielSecuriteLegal->setBateau($this);
        }

        return $this;
    }

    public function removeMaterielSecuriteLegal(MaterielSecuriteLegal $materielSecuriteLegal): self
    {
        if ($this->materielSecuriteLegals->contains($materielSecuriteLegal)) {
            $this->materielSecuriteLegals->removeElement($materielSecuriteLegal);
            // set the owning side to null (unless already changed)
            if ($materielSecuriteLegal->getBateau() === $this) {
                $materielSecuriteLegal->setBateau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Electricite[]
     */
    public function getElectricites(): Collection
    {
        return $this->electricites;
    }

    public function addElectricite(Electricite $electricite): self
    {
        if (!$this->electricites->contains($electricite)) {
            $this->electricites[] = $electricite;
            $electricite->setBateau($this);
        }

        return $this;
    }

    public function removeElectricite(Electricite $electricite): self
    {
        if ($this->electricites->contains($electricite)) {
            $this->electricites->removeElement($electricite);
            // set the owning side to null (unless already changed)
            if ($electricite->getBateau() === $this) {
                $electricite->setBateau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Accastillage[]
     */
    public function getAccastillages(): Collection
    {
        return $this->accastillages;
    }

    public function addAccastillage(Accastillage $accastillage): self
    {
        if (!$this->accastillages->contains($accastillage)) {
            $this->accastillages[] = $accastillage;
            $accastillage->setBateau($this);
        }

        return $this;
    }

    public function removeAccastillage(Accastillage $accastillage): self
    {
        if ($this->accastillages->contains($accastillage)) {
            $this->accastillages->removeElement($accastillage);
            // set the owning side to null (unless already changed)
            if ($accastillage->getBateau() === $this) {
                $accastillage->setBateau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Outillage>
     */
    public function getOutillages(): Collection
    {
        return $this->outillages;
    }

    public function addOutillage(Outillage $outillage): self
    {
        if (!$this->outillages->contains($outillage)) {
            $this->outillages[] = $outillage;
            $outillage->setBateau($this);
        }

        return $this;
    }

    public function removeOutillage(Outillage $outillage): self
    {
        if ($this->outillages->removeElement($outillage)) {
            // set the owning side to null (unless already changed)
            if ($outillage->getBateau() === $this) {
                $outillage->setBateau(null);
            }
        }

        return $this;
    }



}
