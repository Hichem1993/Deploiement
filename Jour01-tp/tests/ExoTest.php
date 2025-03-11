<?php

use PHPUnit\Framework\TestCase;

class ExoTest extends TestCase{

    public function test_demo(){   // Règle de nommage des fonctions de test
        // Dans la méthode que l'on va écrire un test

        // Traitement
        $a = 10 - 5;

        // Assertion
        $this->assertSame($a , 5);

    }


    // TEST : Commande :
    // php vendor/bin/phpunit --color tests
    // composer run test (Voir le fichier composer.json)
}