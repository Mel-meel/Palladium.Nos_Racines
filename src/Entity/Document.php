<?php

namespace App\Entity ;

use Doctrine\Common\Collections\ArrayCollection ;
use Doctrine\Common\Collections\Collection ;
use Doctrine\ORM\Mapping as ORM ;

#[ORM\Entity]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id ;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title ;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description ;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'documents')]
    #[ORM\JoinTable(name: 'document_tags')]
    private Collection $tags ;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $createdBy ;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt ;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt ;

    #[ORM\OneToMany(targetEntity: DocumentVersion::class, mappedBy: 'document', cascade: ['persist', 'remove'])]
    private Collection $versions ;

    public function __construct()
    {
        $this->tags = new ArrayCollection() ;
        $this->versions = new ArrayCollection() ;
        $this->createdAt = new \DateTime() ;
        $this->updatedAt = new \DateTime() ;
    }

    public function getId(): int
    {
        return $this->id ;
    }

    public function getTitle(): string
    {
        return $this->title ;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title ;

        return $this ;
    }

    public function getDescription(): ?string
    {
        return $this->description ;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description ;

        return $this ;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags ;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag ;
        }

        return $this ;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag) ;

        return $this ;
    }

    public function getCreatedBy(): User
    {
        return $this->createdBy ;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy ;

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

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt ;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt ;

        return $this ;
    }

    /**
     * @return Collection<int, DocumentVersion>
     */
    public function getVersions(): Collection
    {
        return $this->versions ;
    }

    public function addVersion(DocumentVersion $version): self
    {
        if (!$this->versions->contains($version)) {
            $this->versions[] = $version ;
            $version->setDocument($this) ;
        }

        return $this ;
    }

    public function removeVersion(DocumentVersion $version): self
    {
        if ($this->versions->removeElement($version)) {
            if ($version->getDocument() === $this) {
                $version->setDocument(null) ;
            }
        }

        return $this ;
    }
}