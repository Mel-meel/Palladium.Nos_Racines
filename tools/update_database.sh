#!/bin/bash

# Script pour mettre à jour la base de données à partir des modèles Doctrine

echo "Mise à jour de la base de données depuis le modèle Doctrine..."

# Vérifier si Symfony Console est disponible
if ! [ -x "$(command -v php)" ]; then
    echo "Erreur : PHP n'est pas installé ou introuvable dans le PATH." >&2
    exit 1
fi

if ! [ -f "bin/console" ]; then
    echo "Erreur : Le fichier Symfony Console (bin/console) est introuvable dans le répertoire actuel." >&2
    exit 1
fi

# Générer une nouvelle migration à partir des changements du modèle
echo "Génération des migrations..."
php bin/console make:migration

# Vérifier si la génération de la migration a réussi
if [ $? -ne 0 ]; then
    echo "Erreur : Échec de la génération des migrations." >&2
    exit 1
fi

# Appliquer les migrations à la base de données
echo "Exécution des migrations..."
php bin/console doctrine:migrations:migrate --no-interaction

# Vérifier si les migrations ont été appliquées correctement
if [ $? -ne 0 ]; then
    echo "Erreur : Échec de l'exécution des migrations." >&2
    exit 1
fi

echo "La mise à jour de la base de données a été effectuée avec succès !"