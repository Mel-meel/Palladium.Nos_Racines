<?php

namespace App\Entity ;

use Doctrine\ORM\Mapping as ORM ;

#[ORM\Entity]
class PeopleDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id ;

    #[ORM\ManyToOne(targetEntity: People::class, inversedBy: 'documents')]
    #[ORM\JoinColumn(nullable: false)]
    private People $person ;

    #[ORM\ManyToOne(targetEntity: Document::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Document $document ;

    #[ORM\Column(type: 'string', length: 255)]
    private string $relationType ;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notes = null ;

    public function getId(): int
    {
        return $this->id ;
    }

    public function getPerson(): People
    {
        return $this->person ;
    }

    public function setPerson(People $person): self
    {
        $this->person = $person ;

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

    public function getRelationType(): string
    {
        return $this->relationType ;
    }

    public function setRelationType(string $relationType): self
    {
        $this->relationType = $relationType ;

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
}