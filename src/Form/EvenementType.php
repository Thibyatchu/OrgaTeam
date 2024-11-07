<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Evenement;
use App\Entity\TypeEvenement;
use App\Entity\Equipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('date_debut', null, [
                'widget' => 'single_text',
            ])
            ->add('date_fin', null, [
                'widget' => 'single_text',
            ])
            ->add('lieu')
            ->add('clubs', EntityType::class, [
                'class' => Club::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'by_reference'=>false
            ])
            ->add('evenements', EntityType::class, [
                'class' => TypeEvenement::class,
                'choice_label' => 'nom',
            ])
            ->add('equipe', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => function (Equipe $equipe): string {
                    return $equipe->getClub().' '.$equipe->getCategorie().' '.$equipe->getNumero().' '.$equipe->getNiveau();
                },
                'multiple' => true,
                'by_reference'=>false
            ])

            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
