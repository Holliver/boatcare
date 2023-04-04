<?php

namespace App\Entity;

use App\Repository\DocOutillageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DocOutillageRepository::class)
 */
class DocOutillage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(maxSize = "5M",mimeTypes={ "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" })
     */
    private $docFilename;

    /**
     * @ORM\ManyToOne(targetEntity=Outillage::class, inversedBy="docOutillages")
     */
    private $outillage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDocFilename(): ?string
    {
        return $this->docFilename;
    }

    public function setDocFilename(?string $docFilename): self
    {
        $this->docFilename = $docFilename;

        return $this;
    }

    public function getOutillage(): ?Outillage
    {
        return $this->outillage;
    }

    public function setOutillage(?Outillage $outillage): self
    {
        $this->outillage = $outillage;

        return $this;
    }
}
