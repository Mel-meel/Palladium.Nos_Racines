<?php

namespace App\Entity ;

use Doctrine\ORM\Mapping as ORM ;

#[ORM\Entity]
class Annotation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id ;

    #[ORM\Column(type: 'float')]
    private float $startX ;

    #[ORM\Column(type: 'float')]
    private float $startY ;

    #[ORM\Column(type: 'float')]
    private float $endX ;

    #[ORM\Column(type: 'float')]
    private float $endY ;

    #[ORM\Column(type: 'text')]
    private string $comment ;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt ;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $createdBy ;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null ;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $updatedBy = null ;

    public function __construct()
    {
        $this->createdAt = new \DateTime() ;
    }

    public function getId(): int
    {
        return $this->id ;
    }

    public function getStartX(): float
    {
        return $this->startX ;
    }

    public function setStartX(float $startX): self
    {
        $this->startX = $startX ;

        return $this ;
    }

    public function getStartY(): float
    {
        return $this->startY ;
    }

    public function setStartY(float $startY): self
    {
        $this->startY = $startY ;

        return $this ;
    }

    public function getEndX(): float
    {
        return $this->endX ;
    }

    public function setEndX(float $endX): self
    {
        $this->endX = $endX ;

        return $this ;
    }

    public function getEndY(): float
    {
        return $this->endY ;
    }

    public function setEndY(float $endY): self
    {
        $this->endY = $endY ;

        return $this ;
    }

    public function getComment(): string
    {
        return $this->comment ;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment ;

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

    public function getCreatedBy(): User
    {
        return $this->createdBy ;
    }

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy ;

        return $this ;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt ;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt ;

        return $this ;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy ;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy ;

        return $this ;
    }
}