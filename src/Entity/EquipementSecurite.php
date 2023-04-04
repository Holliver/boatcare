<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipementSecuriteRepository")
 */
class EquipementSecurite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *  @Groups("bateau:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("bateau:read")
     */
    private $designation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *  @Groups("bateau:read")
     */
    private $quantite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups("bateau:read")
     */
    private $marque;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *  @Groups("bateau:read")
     */
    private $datePeremption;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *  @Groups("bateau:read")
     */
    private $dateProchaineRevision;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     *  @Groups("bateau:read")
     */
    private $renouvellementAnnuel;

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
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param mixed $marque
     */
    public function setMarque($marque): void
    {
        $this->marque = $marque;
    }

    /**
     * @return mixed
     */
    public function getDatePeremption()
    {
        return $this->datePeremption;
    }

    /**
     * @param mixed $datePeremption
     */
    public function setDatePeremption($datePeremption): void
    {
        $this->datePeremption = $datePeremption;
    }

    /**
     * @return mixed
     */
    public function getDateProchaineRevision()
    {
        return $this->dateProchaineRevision;
    }

    /**
     * @param mixed $dateProchaineRevision
     */
    public function setDateProchaineRevision($dateProchaineRevision): void
    {
        $this->dateProchaineRevision = $dateProchaineRevision;
    }

    /**
     * @return mixed
     */
    public function getRenouvellementAnnuel()
    {
        return $this->renouvellementAnnuel;
    }

    /**
     * @param mixed $renouvellementAnnuel
     */
    public function setRenouvellementAnnuel($renouvellementAnnuel): void
    {
        $this->renouvellementAnnuel = $renouvellementAnnuel;
    }

    /**
     * @return mixed
     */
    public function getAnneeEnCours()
    {
        return $this->anneeEnCours;
    }

    /**
     * @param mixed $anneeEnCours
     */
    public function setAnneeEnCours($anneeEnCours): void
    {
        $this->anneeEnCours = $anneeEnCours;
    }

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $anneeEnCours;

    /**
     * @ORM\ManyToOne(targetEntity=MaterielSecuriteLegal::class, inversedBy="equipementSecurites")
     */
    private $materielSecuriteLegal;

    /**
     * @ORM\OneToMany(targetEntity=DocEquipementSecurite::class, mappedBy="equipementSecurite")
     */
    private $docEquipementSecurites;

    public function __construct()
    {
        $this->docEquipementSecurites = new ArrayCollection();
        $this->quantite = 1;
    }

    public function getMaterielSecuriteLegal(): ?MaterielSecuriteLegal
    {
        return $this->materielSecuriteLegal;
    }

    public function setMaterielSecuriteLegal(?MaterielSecuriteLegal $materielSecuriteLegal): self
    {
        $this->materielSecuriteLegal = $materielSecuriteLegal;

        return $this;
    }

    /**
     * @return Collection|DocEquipementSecurite[]
     */
    public function getDocEquipementSecurites(): Collection
    {
        return $this->docEquipementSecurites;
    }

    public function addDocEquipementSecurite(DocEquipementSecurite $docEquipementSecurite): self
    {
        if (!$this->docEquipementSecurites->contains($docEquipementSecurite)) {
            $this->docEquipementSecurites[] = $docEquipementSecurite;
            $docEquipementSecurite->setEquipementSecurite($this);
        }

        return $this;
    }

    public function removeDocEquipementSecurite(DocEquipementSecurite $docEquipementSecurite): self
    {
        if ($this->docEquipementSecurites->contains($docEquipementSecurite)) {
            $this->docEquipementSecurites->removeElement($docEquipementSecurite);
            // set the owning side to null (unless already changed)
            if ($docEquipementSecurite->getEquipementSecurite() === $this) {
                $docEquipementSecurite->setEquipementSecurite(null);
            }
        }

        return $this;
    }

}
