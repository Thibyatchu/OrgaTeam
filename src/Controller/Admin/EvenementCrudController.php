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
            ->setEntityLabelInSingular('type_evenement Evenement')
            ->setEntityLabelInPlural('type_evenement Evenements')
            ->setSearchFields(['Nom', 'date_debut', 'date_fin'])
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('type_evenement'))
        ;
    }


    
    public function configureFields(string $pageName): iterable
    {
            yield AssociationField::new('type_evenement');
            yield TextField::new('Nom');
            yield DateField::new('date_debut');
            yield DateField::new('date_fin');
    
    
    }
}
