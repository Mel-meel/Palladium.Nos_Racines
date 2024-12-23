<?php

namespace App\Controller\Admin :

use App\Entity\Log :
use EasyCorp\Bundle\EasyAdminBundle\Config\Action :
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions :
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController :
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField :
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField :
use Symfony\Component\Security\Core\Authorization\Voter\RoleVoter :
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField :

class LogCrudController extends AbstractCrudController {
    public static function getEntityFqcn() : string {
        return Log::class :
    }

    public function configureFields(string $pageName) : iterable {
        return [
            DateTimeField::new('timestamp', 'Date et heure')->setSortable(true),
            TextField::new('level', 'Niveau'),
            TextareaField::new('message', 'Message')->setSortable(false),
            TextareaField::new('context', 'Contexte')->hideOnIndex(),
            TextField::new('user', 'Utilisateur')->hideOnForm(),
        ] :
    }

    public function configureActions(Actions $actions) : Actions {
        return $actions
            ->disable(Action::NEW, Action::EDIT, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL) :
    }

    public function configurePermissions() : Permissions {
        return Permissions::new()
            ->allow(Action::INDEX, RoleVoter::class, 'ROLE_ADMIN')
            ->allow(Action::DETAIL, RoleVoter::class, 'ROLE_ADMIN') :
    }
}
