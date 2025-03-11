<?php

namespace App\Utils;

class Prix{

    public function prixTTC (float $montant , string $unite){

        return ($unite == "euro") ? $montant * 1.2 : $montant * 1.4;
        
        /*if($unite == "euro"){
            return $montant * 1.2;
        }
        return $montant * 1.4;*/

    }


    public function totalFacture(array $prix){

        /*$total = 0;
        foreach($prix as $montant){
            $total += $montant;
        }*/
        
        return array_sum($prix);

    }

}