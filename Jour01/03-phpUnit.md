# PHPunit :

- PHPunit : https://phpunit.de/index.html

1. Pour installer PHPunit il faut OBLIGATOIREMENT avoir préalableavoir installer Composer

      1. Installation Composer : https://docs.phpunit.de/en/12.0/installation.html#composer
```sh
cd Jour01-tp
composer require --dev phpunit/phpunit
``` 

## Les fichiers intéressants :
- vendor/bin/phpunit
- composer.json


## composer.json :

```json
{
    "require-dev": {
        "phpunit/phpunit": "^12.0"
    }
}
```

## vendor/bin/phpunit :
- fichier PHP (bien qu'il n'ait pas de l'extension PHP)
- fichier PHP EXECUTABLE


## Lancer des tests :
```sh
cd Jour01-tp
php vendor/bin/phpunit
php vendor/bin/phpunit [option] <dossier_qui_contient_test>
``` 


## Organisation :
1. Créer un dossier `tests`
2. Dans le dossier `tests`, créer un fichier `PremierTest.php`