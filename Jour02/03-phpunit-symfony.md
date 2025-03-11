# Symfony est livré avec PHPUnit

symfony new <projet> --webapp

===> PHPUnit est intégré par défaut dans le téléchargement

==> TestCase (TestUnitaire)
==> Test d'intégration (proposés automatiquement)

symfony console make:crud


## Cas pratique :
=> créer un nouveau projet symfony 

jour02-tp 

=> créer une base de données SQLite 

// créer une entité Auteur 

=> id PK 
=> prenom
=> nom
=> age
=> dt_creation 

// créer la table dans la base données

// créer un crud sur cette table => 
// attention mettre yes au moment où il va vous proposer des créer des tests d'intégration




## Découverte :
1.

```php
// test d'intégration
// test qui réaliser une cas d'espèce de l'application
class AuteurContollerTest extends WebTestCase{

    // Méthode magique de la librairie PHPUnit
    // Exécuter automatiquement avant chaque méthode de test
    // Va être exécuter 5 fois
    // Méthode permet d'initialiser des variables pour l'ensemble des méthodes de test
    protected function setUp(){}

    // Autantde test que de méthode dans le fichier AuteurController
    public function testIndex(){}
    public function testNew(){}
    public function testShow(){}
    public function testEdit(){}
    public function testRemove(){}
}
```





## composer.json

    "scripts": {
        "test" : "php bin/phpunit",
        "auto-scripts": {
            "cache:clear": "symfony-cmd",
            "assets:install %PUBLIC_DIR%": "symfony-cmd",
            "importmap:install": "symfony-cmd"
        },
