<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterielSecuriteRepository")
 */
class MaterielSecuriteLegal
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
    public function getNavcotiere()
    {
        return $this->navcotiere;
    }

    /**
     * @param mixed $navcotiere
     */
    public function setNavcotiere($navcotiere): void
    {
        $this->navcotiere = $navcotiere;
    }

    /**
     * @return mixed
     */
    public function getSemihauturiere()
    {
        return $this->semihauturiere;
    }

    /**
     * @param mixed $semihauturiere
     */
    public function setSemihauturiere($semihauturiere): void
    {
        $this->semihauturiere = $semihauturiere;
    }

    /**
     * @return mixed
     */
    public function getHaututiere()
    {
        return $this->haututiere;
    }

    /**
     * @param mixed $haututiere
     */
    public function setHaututiere($haututiere): void
    {
        $this->haututiere = $haututiere;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire): void
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @ORM\Column(type="boolean")
     */
    private $navcotiere;

    /**
     * @ORM\Column(type="boolean")
     */
    private $semihauturiere;

    /**
     * @ORM\Column(type="boolean")
     */
    private $haututiere;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Bateau::class, inversedBy="materielSecuriteLegals")
     */
    private $bateau;

    /**
     * @ORM\OneToMany(targetEntity=EquipementSecurite::class, mappedBy="materielSecuriteLegal")
     * @Groups("bateau:read")
     */
    private $equipementSecurites;

    public function __construct()
    {
        $this->equipementSecurites = new ArrayCollection();
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
     * @return Collection|EquipementSecurite[]
     */
    public function getEquipementSecurites(): Collection
    {
        return $this->equipementSecurites;
    }

    public function addEquipementSecurite(EquipementSecurite $equipementSecurite): self
    {
        if (!$this->equipementSecurites->contains($equipementSecurite)) {
            $this->equipementSecurites[] = $equipementSecurite;
            $equipementSecurite->setMaterielSecuriteLegal($this);
        }

        return $this;
    }

    public function removeEquipementSecurite(EquipementSecurite $equipementSecurite): self
    {
        if ($this->equipementSecurites->contains($equipementSecurite)) {
            $this->equipementSecurites->removeElement($equipementSecurite);
            // set the owning side to null (unless already changed)
            if ($equipementSecurite->getMaterielSecuriteLegal() === $this) {
                $equipementSecurite->setMaterielSecuriteLegal(null);
            }
        }

        return $this;
    }

}
