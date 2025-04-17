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
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('date_debut', DateTimeType::class, [
                'widget' => 'single_text', // Utilisez un champ de type datetime
                'required' => true,
            ])
            ->add('date_fin', DateTimeType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('lieu')

            ->add('evenements', EntityType::class, [
                'class' => TypeEvenement::class,
                'choice_label' => 'nom',
            ])
            ->add('equipe', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => function (Equipe $equipe): string {
                    return $equipe->getCategorie().' '.$equipe->getNiveau();
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
