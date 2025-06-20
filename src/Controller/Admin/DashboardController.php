<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use App\Entity\Categorie;
use App\Entity\Equipe;
use App\Entity\User;
use App\Entity\Evenement;
use App\Entity\TypeEvenement;
use App\Entity\Message;
use App\Entity\MessageTraite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        #return parent::index();
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ClubCrudController::class)->generateUrl();

        return $this->redirect($url);
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Club', 'fas fa-map-marker-alt', Club::class);
        yield MenuItem::linkToCrud('Equipes', 'fas fa-map-marker-alt', Equipe::class);
        yield MenuItem::linkToCrud('Categorie', 'fas fa-map-marker-alt', Categorie::class);
        yield MenuItem::linkToCrud('Evenement', 'fas fa-map-marker-alt', Evenement::class);
        yield MenuItem::linkToCrud('TypeEvenement', 'fas fa-map-marker-alt', TypeEvenement::class);
        yield MenuItem::linkToCrud('Message', 'fas fa-envelope', Message::class);
    }
}
