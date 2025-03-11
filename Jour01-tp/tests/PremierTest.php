<?php

use PHPUnit\Framework\TestCase;

class PremierTest extends TestCase{

    public function test_exemple1(){   // Règle de nommage des fonctions de test
        // Dans la méthode que l'on va écrire un test

        // Traitement
        $a = 1 + 1;

        // Assertion
        $this->assertSame($a , 2);

    }


    /** 
     * @test 
     */
    public function test_exemple2(){   // OU utiliser une annotation avant la méthode

        // Traitement
        $a = "Bonjour" . "les amis";

        // Assertion
        $this->assertSame($a , "Bonjourles amis");
    }

    // TEST : Commande :
    // php vendor/bin/phpunit --color tests
    // composer run test (Voir le fichier composer.json)
}