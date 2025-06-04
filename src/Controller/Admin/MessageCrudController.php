<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use App\Entity\MessageTraite;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Message::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield TextField::new('email');
        yield TextareaField::new('libelle');
        yield BooleanField::new('traiter');
    }

    public function configureActions(Actions $actions): Actions
    {
        $traiter = Action::new('traiter', 'Traiter')
            ->linkToCrudAction('traiterMessage')
            ->displayIf(static function ($entity) {
                return !$entity->isTraiter();
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $traiter)
            ->add(Crud::PAGE_DETAIL, $traiter);
    }

    public function traiterMessage(AdminContext $context, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator): RedirectResponse
    {
        /** @var Message $message */
        $message = $context->getEntity()->getInstance();

        // Marquer comme traité
        $message->setTraiter(true);

        // Créer un MessageTraite et copier les infos
        $messageTraite = new MessageTraite();
        $messageTraite->setNom($message->getNom());
        $messageTraite->setPrenom($message->getPrenom());
        $messageTraite->setEmail($message->getEmail());
        $messageTraite->setLibelle($message->getLibelle());
        $messageTraite->setDateTraite(new \DateTime());

        $entityManager->persist($messageTraite);
        $entityManager->remove($message);
        $entityManager->flush();

        $url = $urlGenerator->generate('admin', [
            'crudControllerFqcn' => self::class,
        ]);
        return new RedirectResponse($url);
    }
}
