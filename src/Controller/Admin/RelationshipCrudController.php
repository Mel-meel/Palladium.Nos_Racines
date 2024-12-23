<?php

namespace App\Controller\Admin;

use App\Entity\Relationship;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class RelationshipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Relationship::class;
    }

    public function configureFields(string $pageName): iterable
    {
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
        ];
    }

    public function configureCrud(\EasyCorp\Bundle\EasyAdminBundle\Config\Crud $crud): \EasyCorp\Bundle\EasyAdminBundle\Config\Crud
    {
        return $crud
            ->setEntityLabelInSingular('Relation')
            ->setEntityLabelInPlural('Relations')
            ->setSearchFields(['personOne.firstName', 'personTwo.firstName', 'relationshipType'])
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureActions(\EasyCorp\Bundle\EasyAdminBundle\Config\Actions $actions): \EasyCorp\Bundle\EasyAdminBundle\Config\Actions
    {
        return $actions
            ->add(\EasyCorp\Bundle\EasyAdminBundle\Config\Crud::PAGE_INDEX, \EasyCorp\Bundle\EasyAdminBundle\Config\Action::NEW)
            ->add(\EasyCorp\Bundle\EasyAdminBundle\Config\Crud::PAGE_EDIT, \EasyCorp\Bundle\EasyAdminBundle\Config\Action::SAVE_AND_RETURN)
            ->add(\EasyCorp\Bundle\EasyAdminBundle\Config\Crud::PAGE_EDIT, \EasyCorp\Bundle\EasyAdminBundle\Config\Action::SAVE_AND_CONTINUE)
            ->setPermission(\EasyCorp\Bundle\EasyAdminBundle\Config\Action::DELETE, 'ROLE_ADMIN')
            ->setPermission(\EasyCorp\Bundle\EasyAdminBundle\Config\Action::NEW, 'ROLE_AUTHOR')
            ->setPermission(\EasyCorp\Bundle\EasyAdminBundle\Config\Action::EDIT, 'ROLE_AUTHOR');
    }
}