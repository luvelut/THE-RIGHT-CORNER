# THE-RIGHT-CORNER
[Symfony] Mini "le bon coin"

Site web réalisé dans le cadre de tests techniques avec plusieurs contraintes et fonctionnalitées obligatoires, comme par exemple la gestion d'un CRUD dans une partie administration du site et d'autres élements essentiels à connaitre lors de l'utilisation du framework Symfony.

## Installation du repository

Pour installer le projet en local sur votre machine, veuillez suivre les différentes étapes : 

### 1. Cloner le repository

### 2. Configurer le [.env](./.env)

Pour cela, renseignez les informations de la base de données (DATA_URL)

⚠️ Vous devez avoir au préalable créer votre base de données, vous pouvez directement l'importer grâce au fichier .sql contenu dans le dépôt.

### 3. Installer les dependances php : `composer i`

### 4. Installer les dépendances js : `yarn` **ou** `npm i`

### 5. Lancer le serveur *Symfony* : `symfony serve`

### 6. Lancer le serveur *Webpack Encore* : `yarn dev-server` **ou** `npm run dev-server`

Pour accéder à la partie admin, vous pouvez utiliser ces identifiants :

* Identifiant : admin
* Mot de passe : admin

Pour accéder à la partie utilisateur, vous pouvez soit vous inscrire, soit utiliser ces identifiants :

* Identifiant : membre1
* Mot de passe : membre1


## Travail réalisé

* Maquettes (mockup) de l'application : listing des pages nécessaires et des champs qui seront dans les formulaires (permet de s'assurer que l'on ne va rien oublier lors de la création de la base de données)
* Réalisation du schéma UML :
(photo du schéma)
* Création de la base de données et des fixtures du site
* Développement puis intégration


## Aperçu du site

Accueil (liste des 10 dernières annonces avec recherche) : possibilité de voir chaque annonce en détaik en cliquant dessus.
(photo index front)

Connexion et inscription 
(photo connexion et inscription)

Partie utilisateur : navigation grâce au menu déroulant, gestion de ses propres annonces et modification de ses données personnelles.

Partie administration : navigation grâce au menu déroulant, gestion des annonces et des utilisateurs (CRUD)
(photo partie admin)
