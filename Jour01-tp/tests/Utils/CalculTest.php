<?php

use App\Utils\Calcul;
use PHPUnit\Framework\TestCase;

class CalculTest extends TestCase{

    public function test_addition(){
        $calcul = new Calcul();
        $resultat = $calcul->addition(1,2);
        $this->assertSame($resultat , 3);
    }

}