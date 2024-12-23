<?php

namespace App\Service ;

use App\Entity\MenuConfiguration ;
use App\Service\LogService ;
use Doctrine\ORM\EntityManagerInterface ;
use Twig\Environment ;

class MenuService {
    private EntityManagerInterface $entityManager ;
    private LogService $logService ;
    private Environment $twig ;

    public function __construct(EntityManagerInterface $entityManager, LogService $logService, Environment $twig) {
        $this->entityManager = $entityManager ;
        $this->logService = $logService ;
        $this->twig = $twig ;
    }

    /**
     * Récupère un menu par son ID.
     */
    public function getMenu(int $menuId) : ?MenuConfiguration {
        /** @var MenuConfiguration|null $menuConfig */
        $menuConfig = $this->entityManager->getRepository(MenuConfiguration::class)->find($menuId) ;

        if (!$menuConfig) {
            $this->logService->addLog(
                message: sprintf('Menu ID %d not found.', $menuId),
                level: 'warning',
                context: 'MenuService::getMenu'
            ) ;
            return null ;
        }

        $this->logService->addLog(
            message: sprintf('Menu ID %d successfully retrieved.', $menuId),
            level: 'info',
            context: 'MenuService::getMenu'
        ) ;

        return $menuConfig ;
    }

    /**
     * Rend le menu pour être directement utilisé dans Twig.
     */
    public function renderMenu(?int $menuId) : string {
        $menuConfig = $this->getMenu($menuId) ;

        if (!$menuConfig) {
            return '' ; // Retourne une chaîne vide si le menu n'est pas trouvé
        }

        $this->logService->addLog(
            message: sprintf('Rendering menu ID %d.', $menuId),
            level: 'info',
            context: 'MenuService::renderMenu'
        ) ;

        return $this->twig->render('partials/mainmenu.html.twig', [
            'menuConfig' => $menuConfig,
        ]) ;
    }
}