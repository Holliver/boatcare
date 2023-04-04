<?php

namespace App\Entity;

use App\Repository\DocEquipementSecuriteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocEquipementSecuriteRepository::class)
 */
class DocEquipementSecurite
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $doc_filename;

    /**
     * @ORM\ManyToOne(targetEntity=EquipementSecurite::class, inversedBy="docEquipementSecurites")
     */
    private $equipementSecurite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDocFilename(): ?string
    {
        return $this->doc_filename;
    }

    public function setDocFilename(string $doc_filename): self
    {
        $this->doc_filename = $doc_filename;

        return $this;
    }

    public function getEquipementSecurite(): ?EquipementSecurite
    {
        return $this->equipementSecurite;
    }

    public function setEquipementSecurite(?EquipementSecurite $equipementSecurite): self
    {
        $this->equipementSecurite = $equipementSecurite;

        return $this;
    }
}
