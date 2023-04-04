<?php

namespace App\Entity;

use App\Repository\DocMoteurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocMoteurRepository", repositoryClass=DocMoteurRepository::class)
 */
class DocMoteur
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
     * @Assert\File(maxSize = "5M",mimeTypes={ "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" })
     */
    private $doc_filename;

    /**
     * @ORM\ManyToOne(targetEntity=Moteur::class, inversedBy="docMoteurs")
     */
    private $moteur;

    public function getId(): ?int
    {
        return $this->id;
    }

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
    public function setDescription( $description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDocFilename()
    {
        return $this->doc_filename;
    }

    public function setDocFilename(string $doc_filename): self
    {
        $this->doc_filename = $doc_filename;

        return $this;
    }

    /**
     * @return Moteur|null
     */
    public function getMoteur(): ?Moteur
    {
        return $this->moteur;
    }

    /**
     * @param Moteur|null $moteur
     *  @return $this
     */
    public function setMoteur(?Moteur $moteur): self
    {
        $this->moteur = $moteur;
        return $this;
    }

    public function __toString(): string
    {
        return $this->doc_filename;
    }
}
