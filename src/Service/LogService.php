<?php
namespace App\Service ;

use App\Entity\Log ;
use Doctrine\ORM\EntityManagerInterface ;
use Symfony\Component\Security\Core\Security ;
use InvalidArgumentException ;

class LogService
{
    private EntityManagerInterface $entityManager ;
    private ?string $currentUser ;

    // Liste des niveaux de log autorisés
    private const VALID_LOG_LEVELS = ['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'] ;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager ;
        $this->currentUser = $security->getUser()?->getUsername() ; // Récupérer l'utilisateur courant
    }

    /**
     * Ajoute un log avec les informations spécifiées.
     *
     * @param string|null $level Le niveau du log (doit être valide, par défaut ; 'info').
     * @param string $message Le message du log.
     * @param string|null $context Contexte supplémentaire.
     * @param string|null $user Utilisateur spécifié (facultatif, remplace l'utilisateur courant).
     * @param \DateTimeInterface|null $timestamp Date et heure du log (par défaut ; maintenant).
     * @return Log Le log créé.
     * @throws InvalidArgumentException Si les paramètres sont invalides.
     */
    public function addLog(
        string $message,
        ?string $level = 'info',
        ?string $context = null,
        ?string $user = null,
        ?\DateTimeInterface $timestamp = null
    ): Log {
        // Définir la date/heure par défaut si non spécifiée
        $timestamp = $timestamp ?? new \DateTime() ;

        // Validation du niveau de log
        if ($level === null) {
            $level = 'info' ;
        }

        if (!in_array($level, self::VALID_LOG_LEVELS, true)) {
            throw new InvalidArgumentException(sprintf('Invalid log level: %s', $level)) ;
        }

        // Validation du message
        if (strlen($message) === 0) {
            throw new InvalidArgumentException('Log message cannot be empty.') ;
        }

        // Limitation de la taille du contexte
        if ($context !== null && strlen($context) > 1000) {
            $context = substr($context, 0, 1000) . '...' ; // Tronquer si trop long
        }

        // Définir l'utilisateur par défaut si non spécifié
        $user = $user ?? $this->currentUser ;

        // Créer l'entité Log
        $log = new Log() ;
        $log->setLevel($level) ;
        $log->setMessage($message) ;
        $log->setContext($context) ;
        $log->setUser($user) ;
        $log->setTimestamp($timestamp) ;

        // Persister le log
        $this->entityManager->persist($log) ;
        $this->entityManager->flush() ;

        return $log ; // Retourner l'entité pour un éventuel suivi
    }

    /**
     * Vérifie si un niveau de log est valide.
     *
     * @param string $level Niveau à vérifier.
     * @return bool True si valide, False sinon.
     */
    public function isValidLogLevel(string $level): bool
    {
        return in_array($level, self::VALID_LOG_LEVELS, true) ;
    }

    /**
     * Liste des niveaux de log autorisés.
     *
     * @return array Liste des niveaux de log.
     */
    public function getValidLogLevels(): array
    {
        return self::VALID_LOG_LEVELS ;
    }
}
