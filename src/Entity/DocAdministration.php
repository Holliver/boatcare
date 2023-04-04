<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocAdministrationRepository")
 */
class DocAdministration
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
     * @ORM\Column(type="string", length=255)
     *  @Assert\File(maxSize = "5M",mimeTypes={ "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" })
     */

    private $docFilename;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Administration", inversedBy="docAdministrations")
     */
    private $administration;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAdministration()
    {
        return $this->administration;
    }

    /**
     * @param mixed $administration
     */
    public function setAdministration($administration): void
    {
        $this->administration = $administration;
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

    public function __toString(): string
    {
        return $this->docFilename;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
