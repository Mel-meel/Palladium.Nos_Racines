<?php

namespace App\Controller\Admin ;

use App\Entity\GlobalConfigurations ;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController ;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField ;
use Symfony\Contracts\Translation\TranslatorInterface ;

class GlobalConfigurationCrudController extends AbstractCrudController {
    private TranslatorInterface $translator ;

    public function __construct(TranslatorInterface $translator) {
        $this->translator = $translator ;
    }

    public static function getEntityFqcn() : string {
        return GlobalConfigurations::class ;
    }

    public function configureFields(string $pageName) : iterable {
        return [
            TextField::new('globalClanName', $this->translator->trans('global_clan_name')),
            BooleanField::new('maintenanceMode', $this->translator->trans('maintenance_mode')),
            BooleanField::new('activeConnectionLinkStartPage', $this->translator->trans('active_connection_link_start_page')),
            BooleanField::new('activeReceptionTemplate', $this->translator->trans('active_reception_template')),
            ChoiceField::new('globalDefaultLanguage', $this->translator->trans('global_default_language'))
                ->setChoices([
                    $this->translator->trans('Français') => 'fr',
                    $this->translator->trans('Anglais') => 'en',
                    $this->translator->trans('Espagnol') => 'es',
                ]),
            BooleanField::new('multilanguageFamily', $this->translator->trans('multilanguage_family')),
            TextField::new('customFooterText', $this->translator->trans('custom_footer_text'))->hideOnIndex(),
            IntegerField::new('customAdvancedMainMenu', $this->translator->trans('custom_advanced_main_menu')),
            IntegerField::new('customAdvancedMainMenuMobile', $this->translator->trans('custom_advanced_main_menu_mobile')),
        ] ;
    }
}