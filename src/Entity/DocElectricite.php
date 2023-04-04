<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocElectroniqueRepository")
 */
class DocElectricite
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
     *  @Assert\File(maxSize = "5M",mimeTypes={ "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" })
     */

    private $docFilename;

    /**
     * @ORM\ManyToOne(targetEntity=Electricite::class, inversedBy="docElectricites")
     */
    private $electricite;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDocFilename()
    {
        return $this->docFilename;
    }

    /**
     * @param mixed $docFilename
     */
    public function setDocFilename($docFilename): void
    {
        $this->docFilename = $docFilename;
    }

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

    public function getElectricite(): ?Electricite
    {
        return $this->electricite;
    }

    public function setElectricite(?Electricite $electricite): self
    {
        $this->electricite = $electricite;

        return $this;
    }

    public function __toString(): string
    {
        return $this->docFilename;
    }
}
