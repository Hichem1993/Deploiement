<?php

namespace App\Utils;

use Exception;

class Exemple {

    public function toto(int $chiffre){

        if ($chiffre < 0) {
            throw new Exception("Attention le chiffre doit être positif");
        }
        return $chiffre;
        
    }

}