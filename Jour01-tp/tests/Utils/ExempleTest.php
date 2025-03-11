<?php

use App\Utils\Exemple;
use PHPUnit\Framework\TestCase;

class ExempleTest extends TestCase{

    public function test_assertion1(){

        $tableau =[
            "id" => 1 ,
            "nom" => "Alain",
            "time" => time()
        ];

        sleep(1);

        $expected_tableau=[
            "id" => 1 ,
            "nom" => "Alain",
            "time" => time()
        ];

        $this->assertArrayIsIdenticalToArrayOnlyConsideringListOfKeys($tableau , $expected_tableau , ["id", "nom"]); 
    }



    public function test_assertion2(){

        // Vérification en type et en valeur (===)
        $this->assertSame("2" , 2);  // Erreur


        // Vérification valeur (==)
        $this->assertEquals("2" , 2);  // OK


        $tableau=[0, null , [] , "", -0 , false];  // des valeurs vides
        foreach ($tableau as $valeur) {
            // Retour des valeur vide 
            $this->assertEmpty($valeur);  // OK
        }
        


        // Vérification string dans un tableau
        $this->assertContains("Alain" , ["Zorro" , "Hichem" , "Alain"]);  // OK



        // Vérification chaine dans un chaine
        $this->assertStringContainsString("Alain" , "bonjour Alain");  // OK
    }




    public function test_toto(){

        $exemple = new Exemple();
        $resultat = $exemple->toto(1);

        $this->assertEquals(1, $resultat);

        // il faut mettre l'exception avant le traitement
        $this->expectException(\Exception::class);
        $exemple->toto(-1);

    }

}