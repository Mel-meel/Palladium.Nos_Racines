<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AnnotationLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Annotation::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Annotation $annotation;

    #[ORM\ManyToOne(targetEntity: Photo::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Photo $photo = null;

    #[ORM\ManyToOne(targetEntity: DocumentVersion::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?DocumentVersion $documentVersion = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAnnotation(): Annotation
    {
        return $this->annotation;
    }

    public function setAnnotation(Annotation $annotation): self
    {
        $this->annotation = $annotation;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDocumentVersion(): ?DocumentVersion
    {
        return $this->documentVersion;
    }

    public function setDocumentVersion(?DocumentVersion $documentVersion): self
    {
        $this->documentVersion = $documentVersion;

        return $this;
    }
}
