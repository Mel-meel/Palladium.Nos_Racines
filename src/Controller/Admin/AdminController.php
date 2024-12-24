<?php

namespace App\Controller\Admin ;

use App\Entity\People ;
use App\Entity\DocumentVersion ;
use App\Entity\Log ;
use App\Entity\User ;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController ;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard ;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem ;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Component\Routing\Annotation\Route ;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index() : Response {
        // Redirige vers une entité spécifique (par exemple : People)
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(PeopleCrudController::class)->generateUrl()) ;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration de la Famille') ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home') ;
        yield MenuItem::linkToCrud('Personnes', 'fa fa-users', People::class) ;
        //yield MenuItem::linkToCrud('Documents', 'fa fa-file-alt', DocumentVersion::class) ;
        yield MenuItem::linkToCrud('Logs', 'fa fa-list', Log::class)->setPermission('ROLE_ADMIN')->setAction('index') ;
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user-cog', User::class)->setPermission('ROLE_ADMIN') ;
    }
}