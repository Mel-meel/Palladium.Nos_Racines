<?php

namespace App\Service ;

use App\Entity\MenuConfiguration ;
use Doctrine\ORM\EntityManagerInterface ;
use Psr\Log\LoggerInterface ;

class MenuService {
    private EntityManagerInterface $entityManager ;
    private LoggerInterface $logger ;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger) {
        $this->entityManager = $entityManager ;
        $this->logger = $logger ;
    }

    /**
     * Récupère et traite le menu depuis l'entité MenuConfiguration.
     *
     * @param int|null $menuId L'identifiant du menu à récupérer.
     * @return array|null Tableau contenant les éléments du menu ou null si non trouvé.
     */
    public function getMenu(?int $menuId) : ?array {
        if ($menuId === null || $menuId <= 0) {
            $this->logger->info('Menu ID invalide ou non spécifié.') ;
            return null ;
        }

        /** @var MenuConfiguration|null $menuConfig */
        $menuConfig = $this->entityManager->getRepository(MenuConfiguration::class)->find($menuId) ;

        if (!$menuConfig) {
            $this->logger->warning(sprintf('Menu ID %d introuvable.', $menuId)) ;
            return null ;
        }

        $this->logger->info(sprintf('Menu ID %d chargé avec succès.', $menuId)) ;

        return [
            'name' => $menuConfig->getName(),
            'orientation' => $menuConfig->getOrientation(),
            'content' => $menuConfig->getContent(),
            'customCSS' => $menuConfig->getCustomCSS(),
        ] ;
    }
}