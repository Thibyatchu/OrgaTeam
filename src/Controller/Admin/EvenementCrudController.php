<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Entity\TypeEvenement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('evenements Evenement')
            ->setEntityLabelInPlural('evenements Evenements')
            ->setSearchFields(['Nom', 'date_debut', 'date_fin', "lieu",])
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('evenements'))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
            yield AssociationField::new('evenements');
            yield TextField::new('Nom');
            yield DateField::new('date_debut');
            yield DateField::new('date_fin');
            yield TextField::new('lieu');
    }
}
