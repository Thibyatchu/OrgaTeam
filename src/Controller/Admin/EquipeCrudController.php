<?php

namespace App\Controller\Admin;

use App\Entity\Equipe;
use App\Entity\Categorie;
use App\Entity\Club;
use App\Entity\Evenement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class EquipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipe::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('categorie Equipe')
            ->setEntityLabelInPlural('categorie Equipe')
            ->setSearchFields(['Niveau', 'Numero', 'Effectif'])

            ->setEntityLabelInSingular('club Equipe')
            ->setEntityLabelInPlural('club Equipe')
            ->setSearchFields(['Niveau', 'Numero', 'Effectif'])

            ->setEntityLabelInSingular('evenement Equipe')
            ->setEntityLabelInPlural('evenement Equipe')
            ->setSearchFields(['Niveau', 'Numero', 'Effectif'])
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('categorie'))
            ->add(EntityFilter::new('club'))
            ->add(EntityFilter::new('evenement'))
        ;
    }


    
    public function configureFields(string $pageName): iterable
    {
            yield AssociationField::new('club');
            yield AssociationField::new('categorie');
            yield TextField::new('Niveau');
            yield IntegerField::new('Numero');
            yield IntegerField::new('Effectif');
    
    
    }
}
