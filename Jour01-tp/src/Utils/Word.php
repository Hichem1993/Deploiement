<?php

namespace App\Utils;

class Word{

    public function voyelle(string $text):array {

        $retour = [];
        $voyelle = ["a" , "e" , "i" , "o" , "u" , "y"];
        
        for ($i = 0; $i < strlen($text) ; $i++) { 
            
            $lettre = $text[$i];
            if (in_array($lettre , $voyelle)) {
                $retour[] = $lettre;
            }

        }

        return $retour;
    }



    public function fizzbuzz(int $number): int|string
    {
        // Si le nombre est divisible à la fois par 3 et par 5, on retourne "fizzbuzz"
        if ($number % 3 === 0 && $number % 5 === 0) {
            return "fizzbuzz";
        }
        // Si le nombre est divisible uniquement par 5, on retourne "buzz"
        elseif ($number % 5 === 0) {
            return "buzz";
        }
        // Si le nombre est divisible uniquement par 3, on retourne "fizz"
        elseif ($number % 3 === 0) {
            return "fizz";
        }
        // Si aucune des conditions précédentes n'est remplie, on retourne le nombre sous forme de chaîne
        else {
            return $number;
        }
    }



    public function palindrome (string $text):string{

        $normalText = str_replace('/', '', $text);
        if ($normalText === strrev($normalText)) {
            return "True";
        }
        return "False";
    }

}