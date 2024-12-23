<?php

namespace App\Entity ;

use Doctrine\Common\Collections\ArrayCollection ;
use Doctrine\Common\Collections\Collection ;
use Doctrine\ORM\Mapping as ORM ;

#[ORM\Entity]
class DocumentVersion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id ;

    #[ORM\Column(type: 'string', length: 255)]
    private string $filePath ;

    #[ORM\Column(type: 'integer')]
    private int $versionNumber ;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt ;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $updatedBy ;

    #[ORM\ManyToOne(targetEntity: Document::class, inversedBy: 'versions')]
    #[ORM\JoinColumn(nullable: false)]
    private Document $document ;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notes ;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $productionDate ;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $transcription ;

    public function __construct()
    {
        $this->createdAt = new \DateTime() ;
    }

    public function getId(): int
    {
        return $this->id ;
    }

    public function getFilePath(): string
    {
        return $this->filePath ;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath ;

        return $this ;
    }

    public function getVersionNumber(): int
    {
        return $this->versionNumber ;
    }

    public function setVersionNumber(int $versionNumber): self
    {
        $this->versionNumber = $versionNumber ;

        return $this ;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt ;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt ;

        return $this ;
    }

    public function getUpdatedBy(): User
    {
        return $this->updatedBy ;
    }

    public function setUpdatedBy(User $updatedBy): self
    {
        $this->updatedBy = $updatedBy ;

        return $this ;
    }

    public function getDocument(): Document
    {
        return $this->document ;
    }

    public function setDocument(Document $document): self
    {
        $this->document = $document ;

        return $this ;
    }

    public function getNotes(): ?string
    {
        return $this->notes ;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes ;

        return $this ;
    }

    public function getProductionDate(): ?\DateTimeInterface
    {
        return $this->productionDate ;
    }

    public function setProductionDate(?\DateTimeInterface $productionDate): self
    {
        $this->productionDate = $productionDate ;

        return $this ;
    }

    public function getTranscription(): ?string
    {
        return $this->transcription ;
    }

    public function setTranscription(?string $transcription): self
    {
        $this->transcription = $transcription ;

        return $this ;
    }
}
