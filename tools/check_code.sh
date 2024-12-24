#!/bin/bash

# Variables générales
LOG_DIR="./logs"
RESULTS_DIR="./results"
TIMESTAMP=$(date +"%Y-%m-%d_%H-%M-%S")
LOG_FILE="${LOG_DIR}/quality_check_${TIMESTAMP}.log"
RESULTS_FILE="${RESULTS_DIR}/quality_check_${TIMESTAMP}.txt"

# Création des répertoires si nécessaire
mkdir -p "$LOG_DIR"
mkdir -p "$RESULTS_DIR"

# Initialisation des compteurs d'erreurs
PHPSTAN_ERRORS=0
ECS_ERRORS=0
RECTOR_ERRORS=0

# Fonction pour exécuter une commande et sauvegarder ses résultats
run_command() {
    local tool_name=$1
    local command=$2
    local errors_var=$3

    echo "Exécution de ${tool_name}..."
    echo "== ${tool_name} ==" >> "$RESULTS_FILE"

    # Exécution de la commande et sauvegarde des résultats
    eval "${command}" &>> "$RESULTS_FILE"
    local exit_code=$?

    # Compter le nombre d'erreurs
    if [ "$exit_code" -ne 0 ]; then
        eval "${errors_var}=\$(grep -oP '(?<=errors: )[0-9]+' <<< \$(tail -n 5 $RESULTS_FILE) | head -n 1 || echo 1)"
    fi

    echo "${tool_name}: ${!errors_var} erreur(s)" >> "$LOG_FILE"
    echo "${tool_name} terminé."
}

# Exécution des outils
echo "Début des analyses - $(date)" > "$LOG_FILE"
echo "Résultats complets disponibles dans ${RESULTS_FILE}" >> "$LOG_FILE"

run_command "PHPStan" "php ./vendor/bin/phpstan analyse --ansi ." PHPSTAN_ERRORS
run_command "ECS" "php ./vendor/bin/ecs check --ansi ." ECS_ERRORS
run_command "Rector" "php ./vendor/bin/rector process --dry-run --ansi ." RECTOR_ERRORS

# Sauvegarde des résultats dans le log
echo -e "\nRésumé des erreurs :\n" >> "$LOG_FILE"
echo "PHPStan: $PHPSTAN_ERRORS erreur(s)" >> "$LOG_FILE"
echo "ECS: $ECS_ERRORS erreur(s)" >> "$LOG_FILE"
echo "Rector: $RECTOR_ERRORS erreur(s)" >> "$LOG_FILE"

# Récapitulatif en sortie standard
echo -e "\nRésumé des analyses :"
cat "$LOG_FILE"

# Résultat final
if [ "$PHPSTAN_ERRORS" -eq 0 ] && [ "$ECS_ERRORS" -eq 0 ] && [ "$RECTOR_ERRORS" -eq 0 ]; then
    echo "✅ Toutes les analyses sont passées avec succès !"
else
    echo "❌ Des erreurs ont été détectées. Consultez le fichier log pour plus de détails : $LOG_FILE"
fi