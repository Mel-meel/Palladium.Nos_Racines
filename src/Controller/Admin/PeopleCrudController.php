<?php

namespace App\Controller\Admin;

use App\Entity\People;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PeopleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return People::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName', 'Prénoms')->setSortable(true),
            TextField::new('lastName', 'Noms de famille')->setSortable(true),
            TextField::new('nickName', 'Surnom')->hideOnIndex(),
            DateField::new('birthDate', 'Date de naissance')->hideOnIndex(),
            DateField::new('deathDate', 'Date de décès')->hideOnIndex(),
            TextField::new('birthPlace', 'Lieu de naissance')->hideOnIndex(),
            TextField::new('deathPlace', 'Lieu de décès')->hideOnIndex(),
            TextareaField::new('biography', 'Biographie')->hideOnIndex(),
            ImageField::new('photo', 'Photo')
                ->setBasePath('uploads/photos')
                ->setUploadDir('public/uploads/photos')
                ->setRequired(false),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Crud::PAGE_NEW)
            ->add(Crud::PAGE_INDEX, Crud::PAGE_EDIT)
            ->add(Crud::PAGE_INDEX, Crud::PAGE_DELETE)
            ->add(Crud::PAGE_INDEX, Crud::PAGE_DETAIL);
    }

    public function configurePermissions(): array
    {
        return [
            'index' => ['ROLE_ADMIN', 'ROLE_AUTHOR'],
            'new' => ['ROLE_ADMIN', 'ROLE_AUTHOR'],
            'edit' => ['ROLE_ADMIN', 'ROLE_AUTHOR'],
            'delete' => ['ROLE_ADMIN'],
        ];
    }
}