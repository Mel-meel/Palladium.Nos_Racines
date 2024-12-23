<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'global_configurations')]
class GlobalConfigurations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $globalClanName;

    #[ORM\Column(type: 'boolean')]
    private bool $maintenanceMode;

    #[ORM\Column(type: 'boolean')]
    private bool $activeConnectionLinkStartPage;

    #[ORM\Column(type: 'boolean')]
    private bool $activeReceptionTemplate;

    #[ORM\Column(type: 'string', length: 10)]
    private string $globalDefaultLanguage;

    #[ORM\Column(type: 'boolean')]
    private bool $multilanguageFamily;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $customFooterText;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $customAdvancedMainMenu;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $customAdvancedMainMenuMobile;

    public function getId(): int
    {
        return $this->id;
    }

    public function getGlobalClanName(): string
    {
        return $this->globalClanName;
    }

    public function setGlobalClanName(string $globalClanName): self
    {
        $this->globalClanName = $globalClanName;
        return $this;
    }

    public function isMaintenanceMode(): bool
    {
        return $this->maintenanceMode;
    }

    public function setMaintenanceMode(bool $maintenanceMode): self
    {
        $this->maintenanceMode = $maintenanceMode;
        return $this;
    }

    public function isActiveConnectionLinkStartPage(): bool
    {
        return $this->activeConnectionLinkStartPage;
    }

    public function setActiveConnectionLinkStartPage(bool $activeConnectionLinkStartPage): self
    {
        $this->activeConnectionLinkStartPage = $activeConnectionLinkStartPage;
        return $this;
    }

    public function isActiveReceptionTemplate(): bool
    {
        return $this->activeReceptionTemplate;
    }

    public function setActiveReceptionTemplate(bool $activeReceptionTemplate): self
    {
        $this->activeReceptionTemplate = $activeReceptionTemplate;
        return $this;
    }

    public function getGlobalDefaultLanguage(): string
    {
        return $this->globalDefaultLanguage;
    }

    public function setGlobalDefaultLanguage(string $globalDefaultLanguage): self
    {
        $this->globalDefaultLanguage = $globalDefaultLanguage;
        return $this;
    }

    public function isMultilanguageFamily(): bool
    {
        return $this->multilanguageFamily;
    }

    public function setMultilanguageFamily(bool $multilanguageFamily): self
    {
        $this->multilanguageFamily = $multilanguageFamily;
        return $this;
    }

    public function getCustomFooterText(): ?string
    {
        return $this->customFooterText;
    }

    public function setCustomFooterText(?string $customFooterText): self
    {
        $this->customFooterText = $customFooterText;
        return $this;
    }

    public function getCustomAdvancedMainMenu(): ?int
    {
        return $this->customAdvancedMainMenu;
    }

    public function setCustomAdvancedMainMenu(?int $customAdvancedMainMenu): self
    {
        $this->customAdvancedMainMenu = $customAdvancedMainMenu;
        return $this;
    }

    public function getCustomAdvancedMainMenuMobile(): ?int
    {
        return $this->customAdvancedMainMenuMobile;
    }

    public function setCustomAdvancedMainMenuMobile(?int $customAdvancedMainMenuMobile): self
    {
        $this->customAdvancedMainMenuMobile = $customAdvancedMainMenuMobile;
        return $this;
    }
}