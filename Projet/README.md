# symfony-ecommerce-alimentation
Application web de vente en ligne de produits alimentaires, construite avec le framework Symfony 7

## Fonctionnalités
- Inscription et connexion des utilisateurs
- Gestion des commandes pour les utilisateurs
- Interface d'administration pour gérer les produits et les commandes

## Prérequis
- PHP 8.2.0 ou supérieur
- Composer
- Symfony CLI
- MySQL ou un autre SGBD compatible

## Installation
- Excécution du Fichier SQL :
    Pour initialiser votre base de données avec le schéma et les données nécessaires, exécutez le fichier 'projet.sql' situé à la racine du projet dans votre SGBD	 

- Configurez votre base de données :
    Modifier le fichier `.env` à la racine du projet et configurez les paramètres de connexion à votre base de données.

- Démarrez le serveur de développement :
    Ouvrir le terminal et naviguez vers le répértoire où vous avez placé le projet et taper la commande :
    symfony server:start (recommandé)
    php -S localhost:8000 -t public

## Utilisation
- Accédez à l'application via `http://localhost:8000` (ou une autre URL spécifiée par le serveur Symfony).
- Inscrivez-vous ou connectez-vous pour accéder à votre compte utilisateur.
- Parcourez les produits disponibles et ajoutez-les à votre panier.
- Passez vos commandes.
- Connectez-vous à l'interface d'administration via `http://localhost:8000/admin` pour gérer les produits et les commandes.
  
## Informations de connexion 
  ### Administrateur
      - URL de connexion : 'http://localhost:8000/login'
      - Email : admin01@gmail.com
      - Mot de passe : 1111
  ### Utilisateur
      - URL de connexion : 'http://localhost:8000/login'
      - Email : user01@gmail.com
      - Mot de passe : 0000

## Structure du Projet
- `src/` : Code source de l'application
- `templates/` : Templates Twig pour les vues
- `public/` : Fichiers publics (assets, index.php, etc.)
- `config/` : Fichiers de configuration
- `migrations/` : Migrations de base de données
- `src/Entity/` : Entités Doctrine
- `src/Repository/` : Répertoires des entités
- `src/Controller/` : Contrôleurs de l'application

## Contributions
Les contributions sont les bienvenues ! Veuillez ouvrir une issue ou soumettre une pull request pour toute amélioration ou correction de bugs.

## Contact
- **Nom** : Tendry Zéphyrin
- **Email** : tendryzephyrin@gmail.com
- **GitHub** : [Tendry-Rkt56](https://github.com/Tendry-Rkt56)
