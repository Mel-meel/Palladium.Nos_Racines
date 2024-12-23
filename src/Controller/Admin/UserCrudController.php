<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use Symfony\Component\Security\Core\Authorization\Voter\RoleVoter;
use EasyCorp\Bundle\EasyAdminBundle\Field\PasswordField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('username', 'Nom d\'utilisateur')->setSortable(true),
            EmailField::new('email', 'Adresse email')->setSortable(true),
            ArrayField::new('roles', 'Rôles')->setSortable(false),
            PasswordField::new('password', 'Mot de passe')->onlyOnForms(),
        ];
    }

    public function configurePermissions(): Permissions
    {
        return Permissions::new()
            ->allow(Action::ALL, RoleVoter::class, 'ROLE_ADMIN');
    }
}