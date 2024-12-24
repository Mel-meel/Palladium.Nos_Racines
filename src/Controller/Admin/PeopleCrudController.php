<?php

namespace App\Controller\Admin ;

use App\Entity\People ;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud ;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

class PeopleCrudController extends AbstractCrudController {
    public static function getEntityFqcn() : string {
        return People::class ;
    }

    public function configureFields(string $pageName) : iterable {
        return [
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            ArrayField::new('firstNames', 'Prénoms')->setSortable(false),
            ArrayField::new('lastNames', 'Noms de famille')->setSortable(false),
            TextField::new('nickName', 'Surnom')->hideOnIndex(),
            ArrayField::new('birthNames', 'Noms de naissance')->setSortable(false),
            DateField::new('birthDate', 'Date de naissance')->hideOnIndex(),
            DateField::new('deathDate', 'Date de décès')->hideOnIndex(),
            TextField::new('birthPlace', 'Lieu de naissance')->hideOnIndex(),
            TextField::new('deathPlace', 'Lieu de décès')->hideOnIndex(),
            TextareaField::new('biography', 'Biographie')->hideOnIndex(),
            //ImageField::new('photo', 'Photo')
            //    ->setBasePath('uploads/photos')
            //    ->setUploadDir('public/uploads/photos')
            //    ->setRequired(false),
        ] ;
    }
    
    public function configurePermissions() : array {
        return [
            'index' => ['ROLE_ADMIN', 'ROLE_AUTHOR'],
            'new' => ['ROLE_ADMIN', 'ROLE_AUTHOR'],
            'edit' => ['ROLE_ADMIN', 'ROLE_AUTHOR'],
            'delete' => ['ROLE_ADMIN'],
        ] ;
    }
}