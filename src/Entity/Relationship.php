<?php

namespace App\Entity ;

use Doctrine\ORM\Mapping as ORM ;

#[ORM\Entity]
#[ORM\Table(name: 'relationships')]
class Relationship
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: People::class, inversedBy: 'relationships')]
    #[ORM\JoinColumn(nullable: false)]
    private People $personOne ;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: People::class)]
    #[ORM\JoinColumn(nullable: false)]
    private People $personTwo ;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    private string $relationshipType ;

    #[ORM\Column(type: 'boolean')]
    private bool $isConfirmed = false ;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $createdAt ;

    public function __construct()
    {
        $this->createdAt = new \DateTime() ;
    }

    public function getPersonOne(): People
    {
        return $this->personOne ;
    }

    public function setPersonOne(People $personOne): self
    {
        $this->personOne = $personOne ;
        return $this ;
    }

    public function getPersonTwo(): People
    {
        return $this->personTwo ;
    }

    public function setPersonTwo(People $personTwo): self
    {
        $this->personTwo = $personTwo ;
        return $this ;
    }

    public function getRelationshipType(): string
    {
        return $this->relationshipType ;
    }

    public function setRelationshipType(string $relationshipType): self
    {
        $this->relationshipType = $relationshipType ;
        return $this ;
    }

    public function isConfirmed(): bool
    {
        return $this->isConfirmed ;
    }

    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed ;
        return $this ;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt ;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt ;
        return $this ;
    }
}