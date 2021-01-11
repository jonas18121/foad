# Créer une application Symfony


## Créer une application Symfony avec la commande symfony

pour avoir la dernière version complète avec toutes les dépendances
    - symfony new my_project_name --full

pour avoir la dernière version en mode microservice, API
    - symfony new my_project_name


## Créer une application Symfony avec la commande composer

pour avoir la dernière version complète avec toutes les dépendances
    - composer create-project symfony/website-skeleton my_project_name

pour avoir la dernière version en mode microservice, API
    - composer create-project symfony/skeleton my_project_name

## Créer une application Symfony avec une version précis avec la commande symfony

pour avoir la dernière version complète avec toutes les dépendances
    - symfony new my_project_name --version=4.4 --full

pour avoir la dernière version en mode microservice, API
    - symfony new my_project_name --version=4.4


## Créer une application Symfony avec une version précis avec la commande composer

pour avoir la dernière version complète avec toutes les dépendances
    - composer create-project symfony/website-skeleton:"^4.4" my_project_name

pour avoir la dernière version en mode microservice, API
    - composer create-project symfony/skeleton:"^4.4" my_project_name

`S'il y a des problème lors de la creation de l'application , faire la même opération dans la CMD de git bash`


## Faire tourner notre application avec la commande symfony

    - symfony server:start

## Faire tourner notre application avec la commande composer

On telecharge un serveur personnalisé via composer, qu'on utiliser seulement lorsqu'on sera en mode développement
    - composer require server --dev

puis on tape la commande
    - php bin/console server:run


## installer le moteur de templating Twig
    - composer require symfony/twig-bundle

## Créer un Controlleur avec la CLI

Symfony Maker vous aide à créer des commandes vides, des contrôleurs, 
des classes de formulaire, des tests et plus encore afin que vous puissiez oublier l'écriture de code standard.

telecharger maker-bundle
    - composer require symfony/maker-bundle --dev

si on veut voir la liste de commande que propose maker-bundle une fois installer
    - php bin/console list make

voici la liste :

        make:auth                   Creates a Guard authenticator of different flavors
        make:command                Creates a new console command class
        make:controller             Creates a new controller class
        make:crud                   Creates CRUD for Doctrine entity class
        make:docker:database        Adds a database container to your docker-compose.yaml file
        make:entity                 Creates or updates a Doctrine entity class, and optionally an API Platform resource
        make:fixtures               Creates a new class to load Doctrine fixtures
        make:form                   Creates a new form class
        make:functional-test        Creates a new functional test class
        make:message                Creates a new message and handler
        make:messenger-middleware   Creates a new messenger middleware
        make:migration              Creates a new migration based on database changes
        make:registration-form      Creates a new registration form system
        make:reset-password         Create controller, entity, and repositories for use with symfonycasts/reset-password-bundle   
        make:serializer:normalizer  Creates a new serializer normalizer class
        make:subscriber             Creates a new event subscriber class
        make:twig-extension         Creates a new Twig extension class
        make:unit-test              Creates a new unit test class
        make:user                   Creates a new security user class
        make:validator              Creates a new validator and constraint class
        make:voter                  Creates a new security voter class

installer les annotaions de doctrine
    - composer require doctrine/annotations

Créer le controlleur
    - php bin/console make:controller

puis répondre on question qui seront poser.


## ORM de Symfony : Doctrine

on installe le symfony/orm-pack qui contient :

`composer/package-versions-deprecated: *`
`doctrine/doctrine-bundle: *`
`doctrine/doctrine-migrations-bundle: *`
`doctrine/orm: *`
`symfony/proxy-manager-bridge: *`

    - composer require symfony/orm-pack

La liste de commande doctrine :

    doctrine:cache:clear-collection-region     
    doctrine:cache:clear-entity-region
    doctrine:cache:clear-metadata
    doctrine:cache:clear-query
    doctrine:cache:clear-query-region
    doctrine:cache:clear-result
    doctrine:database:create
    doctrine:database:drop
    doctrine:database:import
    doctrine:ensure-production-settings        
    doctrine:mapping:convert
    doctrine:mapping:import
    doctrine:mapping:info
    doctrine:migrations:current
    doctrine:migrations:diff
    doctrine:migrations:dump-schema
    doctrine:migrations:execute
    doctrine:migrations:generate
    doctrine:migrations:latest
    doctrine:migrations:list
    doctrine:migrations:migrate
    doctrine:migrations:rollup
    doctrine:migrations:status
    doctrine:migrations:sync-metadata-storage  
    doctrine:migrations:up-to-date
    doctrine:migrations:version
    doctrine:query:dql
    doctrine:query:sql
    doctrine:schema:create
    doctrine:schema:drop
    doctrine:schema:update
    doctrine:schema:validate

puis dans le fichier `.env` on modifie la variable d'environnement DATABASE_URL
(`DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"`) , 
qui va renseigner à Symfony oû ce trouve notre base de données
`Il faudra modifier le : db_user, db_password, db_name`
voici ma bdd : `DATABASE_URL="mysql://root:@127.0.0.1:3306/listing_bulletin_symfony?serverVersion=5.7"`

Après avoir modifier la variable d'environnement DATABASE_URL, on dit a Symfony de créer la base de données

    - php bin/console doctrine:database:create

### Créer une Entité

Dans Symfony avec doctrine une Classe entity représentera une table en base de données

    - php bin/console make:entity

puis répondre aux question poser
ça nous créer une entité et une repository

exemple : 
    created: src/Entity/Eleve.php
    created: src/Repository/EleveRepository.php

### Faire une migration

La migration va permettre a doctrine d'annalysé mon code, il va faire la différence entre la base de données et les entités 
et s'il y a des différence entre eux , il va créer un scrpit SQL versionné en fonction des modification apporter dans les fichiers entity

    - php bin/console make:migration

on lance les script de migrations afin de mettre à jour la base de données

    - php bin/console doctrine:migrations:migrate

répondre `yes` à la question pour mettre a jour la base de données

### les Fixtures

Les fixtures vont servir à avoir un jeux de fausses données
on installe le composant doctrine/doctrine-fixtures-bundle

    - composer require doctrine/doctrine-fixtures-bundle

puis on créer une fixture
    - php bin/console make:fixtures

ça créera un dossier DataFixtures dans lequel , il y aura notre fichier fixtures

et pour executé notre fixtures 

    - php bin/console doctrine:fixtures:load