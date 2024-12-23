<?php

namespace App\Entity ;

use Doctrine\ORM\Mapping as ORM ;
use Doctrine\Common\Collections\ArrayCollection ;
use Doctrine\Common\Collections\Collection ;

#[ORM\Entity]
#[ORM\Table(name: 'menu_configuration')]
class MenuConfiguration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id ;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name ;

    #[ORM\Column(type: 'string', length: 20)]
    private string $orientation = 'horizontal' ; // horizontal or vertical

    #[ORM\Column(type: 'json')]
    private array $content = [] ; // JSON structure for menu items

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $customCSS = null ;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt ;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null ;

    public function __construct()
    {
        $this->createdAt = new \DateTime() ;
    }

    public function getId(): int
    {
        return $this->id ;
    }

    public function getName(): string
    {
        return $this->name ;
    }

    public function setName(string $name): self
    {
        $this->name = $name ;
        return $this ;
    }

    public function getOrientation(): string
    {
        return $this->orientation ;
    }

    public function setOrientation(string $orientation): self
    {
        if (!in_array($orientation, ['horizontal', 'vertical'])) {
            throw new \InvalidArgumentException('Invalid orientation value.') ;
        }
        $this->orientation = $orientation ;
        return $this ;
    }

    public function getContent(): array
    {
        return $this->content ;
    }

    public function setContent(array $content): self
    {
        $this->content = $content ;
        return $this ;
    }

    public function getCustomCSS(): ?string
    {
        return $this->customCSS ;
    }

    public function setCustomCSS(?string $customCSS): self
    {
        $this->customCSS = $customCSS ;
        return $this ;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt ;
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
}