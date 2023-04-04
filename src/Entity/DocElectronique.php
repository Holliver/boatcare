<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocElectroniqueRepository")
 */
class DocElectronique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private mixed $description;

    /**
     * @return mixed
     */
    public function getDescription(): mixed
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription(mixed $description): void
    {
        $this->description = $description;
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(maxSize = "5M",mimeTypes={ "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" })
     */
    private mixed $docFilename;

    /**
     * @ORM\ManyToOne(targetEntity=Electronique::class, inversedBy="docElectroniques")
     */
    private mixed $electronique;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getElectronique(): mixed
    {
        return $this->electronique;
    }

    /**
     * @param mixed $electronique
     */
    public function setElectronique(?Electronique $electronique): void
    {
        $this->electronique = $electronique;
    }

    /**
     * @return mixed
     */
    public function getDocFilename(): mixed
    {
        return $this->docFilename;
    }

    /**
     * @param mixed $docFilename
     */
    public function setDocFilename(mixed $docFilename): void
    {
        $this->docFilename = $docFilename;
    }

    public function __toString(): string
    {
        return $this->docFilename;
    }

    /**
     * @param mixed $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }
}
