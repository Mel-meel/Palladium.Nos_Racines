<?php

namespace App\Controller ;

use App\Service\MenuService ;
use App\Entity\GlobalConfigurations ;
use App\Repository\DocumentRepository ;
use App\Repository\NotificationRepository ;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController ;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Contracts\Translation\TranslatorInterface ;

class StartPageController extends AbstractController {
    private MenuService $menuService ;
    private TranslatorInterface $translator ;

    public function __construct(MenuService $menuService, TranslatorInterface $translator) {
        $this->menuService = $menuService ;
        $this->translator = $translator ;
    }
    
    #[Route(path: '/', name: 'app_startpage')]
    public function index(
        GlobalConfigurations $configurations,
        DocumentRepository $documentRepository,
        NotificationRepository $notificationRepository
    ) : Response {
        // Fetch global configurations
        $config = $configurations->findOneBy([]) ;
        if (!$config) {
            throw $this->createNotFoundException('Configuration not found.') ;
        }

        // Maintenance Mode Check
        if ($config->isMaintenanceMode()) {
            return $this->render('start/maintenance.html.twig', [
                'message' => $this->translator->trans('site_under_maintenance')
            ]) ;
        }

        // Fetch recent documents
        $recentDocuments = $documentRepository->findBy([], ['createdAt' => 'DESC'], 5) ;

        // Fetch notifications
        $notifications = $notificationRepository->findBy([], ['createdAt' => 'DESC']) ;

        // Fetch menus using MenuService
        $menuDesktop = $this->menuService->getMenu($config->getCustomAdvancedMainMenu()) ;
        $menuMobile = $this->menuService->getMenu($config->getCustomAdvancedMainMenuMobile()) ?? $menuDesktop ;

        // Render start page
        return $this->render('start/index.html.twig', [
            'config' => $config,
            'recentDocuments' => $recentDocuments,
            'notifications' => $notifications,
            'customMenu' => $menuDesktop,
            'customMenuMobile' => $menuMobile,
        ]) ;
    }
}
