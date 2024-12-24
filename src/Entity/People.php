<?php

namespace App\Entity ;

use Doctrine\Common\Collections\ArrayCollection ;
use Doctrine\Common\Collections\Collection ;
use Doctrine\ORM\Mapping as ORM ;

#[ORM\Entity]
class People {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'json')]
    private array $firstNames = [] ;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $nickName = null ;

    #[ORM\Column(type: 'json')]
    private array $lastNames = [] ;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $birthNames = [] ;

    #[ORM\Column(type: 'string', length: 50)]
    private string $gender ;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $birthDate = null ;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $deathDate = null ;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $birthPlace = null ;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $deathPlace = null ;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $biography = null ;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $occupation = null ;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photo = null ;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $nationality = null ;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $notes = null ;

    #[ORM\OneToMany(mappedBy: 'personOne', targetEntity: Relationship::class, cascade: ['persist', 'remove'])]
    private Collection $relationships ;

    #[ORM\OneToMany(targetEntity: PeopleDocument::class, mappedBy: 'person', cascade: ['persist', 'remove'])]
    private Collection $documents ;

    #[ORM\OneToMany(targetEntity: PeoplePhoto::class, mappedBy: 'person', cascade: ['persist', 'remove'])]
    private Collection $photos ;

    public function __construct()
    {
        $this->relationships = new ArrayCollection() ;
        $this->documents = new ArrayCollection() ;
        $this->photos = new ArrayCollection() ;
    }

    public function getId(): ?int
    {
        return $this->id ;
    }

    public function getFirstName(): array
    {
        return $this->firstName ;
    }

    public function setFirstName(array $firstName): self
    {
        $this->firstName = $firstName ;

        return $this ;
    }

    public function getNickName(): ?string
    {
        return $this->nickName ;
    }

    public function setNickName(?string $nickName): self
    {
        $this->nickName = $nickName ;

        return $this ;
    }

    public function getLastName(): array
    {
        return $this->lastName ;
    }

    public function setLastName(array $lastName): self
    {
        $this->lastName = $lastName ;

        return $this ;
    }

    public function getBirthName(): ?array
    {
        return $this->birthName ;
    }

    public function setBirthName(?array $birthName): self
    {
        $this->birthName = $birthName ;

        return $this ;
    }

    public function getGender(): string
    {
        return $this->gender ;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender ;

        return $this ;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate ;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate ;

        return $this ;
    }

    public function getDeathDate(): ?\DateTimeInterface
    {
        return $this->deathDate ;
    }

    public function setDeathDate(?\DateTimeInterface $deathDate): self
    {
        $this->deathDate = $deathDate ;

        return $this ;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace ;
    }

    public function setBirthPlace(?string $birthPlace): self
    {
        $this->birthPlace = $birthPlace ;

        return $this ;
    }

    public function getDeathPlace(): ?string
    {
        return $this->deathPlace ;
    }

    public function setDeathPlace(?string $deathPlace): self
    {
        $this->deathPlace = $deathPlace ;

        return $this ;
    }

    public function getBiography(): ?string
    {
        return $this->biography ;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography ;

        return $this ;
    }

    public function getOccupation(): ?string
    {
        return $this->occupation ;
    }

    public function setOccupation(?string $occupation): self
    {
        $this->occupation = $occupation ;

        return $this ;
    }

    public function getPhoto(): ?string
    {
        return $this->photo ;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo ;

        return $this ;
    }

    public function getNationality(): ?string
    {
        return $this->nationality ;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality ;

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

    public function getRelationships(): Collection
    {
        return $this->relationships ;
    }

    public function addRelationship(Relationship $relationship): self
    {
        if (!$this->relationships->contains($relationship)) {
            $this->relationships->add($relationship) ;
        }

        return $this ;
    }

    public function removeRelationship(Relationship $relationship): self
    {
        $this->relationships->removeElement($relationship) ;

        return $this ;
    }

    public function getDocuments(): Collection
    {
        return $this->documents ;
    }

    public function addDocument(PeopleDocument $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document ;
            $document->setPerson($this) ;
        }

        return $this ;
    }

    public function removeDocument(PeopleDocument $document): self
    {
        if ($this->documents->removeElement($document)) {
            if ($document->getPerson() === $this) {
                $document->setPerson(null) ;
            }
        }

        return $this ;
    }

    public function getPhotos(): Collection
    {
        return $this->photos ;
    }

    public function addPhoto(PeoplePhoto $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo ;
            $photo->setPerson($this) ;
        }

        return $this ;
    }

    public function removePhoto(PeoplePhoto $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            if ($photo->getPerson() === $this) {
                $photo->setPerson(null) ;
            }
        }

        return $this ;
    }
}