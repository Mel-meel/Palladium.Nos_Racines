<?php

namespace App\Controller\Admin ;

use App\Entity\Relationship ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions ;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController ;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField ;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class RelationshipCrudController extends AbstractCrudController {
    public static function getEntityFqcn() : string {
        return Relationship::class ;
    }

    public function configureFields(string $pageName) : iterable {
        return [
            AssociationField::new('personOne', 'Personne 1')
                ->setRequired(true),

            AssociationField::new('personTwo', 'Personne 2')
                ->setRequired(true),

            ChoiceField::new('relationshipType', 'Type de relation')
                ->setChoices([
                    'Parent' => 'parent',
                    'Enfant' => 'child',
                    'Conjoint' => 'spouse',
                    'Frère/Sœur' => 'sibling',
                    'Cousin' => 'cousin',
                    'Ami' => 'friend',
                    'Collègue' => 'colleague',
                ])
                ->setRequired(true),

            BooleanField::new('isConfirmed', 'Confirmée'),

            DateTimeField::new('createdAt', 'Date de création')
                ->hideOnForm()
                ->setSortable(true),
        ] ;
    }

    public function configureCrud(Crud $crud) : Crud {
        return $crud
            ->setEntityLabelInSingular('Relation')
            ->setEntityLabelInPlural('Relations')
            ->setSearchFields(['personOne.firstName', 'personTwo.firstName', 'relationshipType'])
            ->setDefaultSort(['createdAt' => 'DESC']) ;
    }

    public function configureActions(Actions $actions) : Actions {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE)
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
            ->setPermission(Action::NEW, 'ROLE_AUTHOR')
            ->setPermission(Action::EDIT, 'ROLE_AUTHOR') ;
    }
}