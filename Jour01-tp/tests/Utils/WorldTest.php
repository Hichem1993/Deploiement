<?php

use App\Utils\Word;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class WorldTest extends TestCase{

    public function test_voyelle(){

        $word = new Word();
        $resultat = $word->voyelle("bonjour");
        $this->assertSame($resultat, ["o" , "o" , "u"]);

        $resultat = $word->voyelle("");
        $this->assertSame($resultat, []);

        $resultat = $word->voyelle("hello");
        $this->assertSame($resultat, ["e" , "o"]);

        $resultat = $word->voyelle("rrrrrr");
        $this->assertSame($resultat, []);

        $resultat = $word->voyelle("aaaa");
        $this->assertSame($resultat, ["a" , "a" , "a" , "a"]);

    }


    #[DataProvider("voyelleProvider")]
    public function test_voyelle2(string $text , array $expected){

        $word = new Word();
        $resultat = $word->voyelle($text);
        $this->assertSame($resultat, $expected);

    }

    public static function voyelleProvider(){
        return [
            "cas bonjour" => ["bonjour" , ["o" , "o" , "u"]],
            "cas vide" => ["" , []],
            "cas hello" => ["hello" , ["e" , "o"]],
            "cas rrrrr" => ["rrrrr" , []],
            "cas aaa" => ["aaaa" , ["a" , "a" , "a" , "a"]]
        ];
    }




    #[DataProvider("fizzbuzzProvider")]
    public function test_fizzbuzz(int $number , int|string $expected){

        $word = new Word();
        $resultat = $word->fizzbuzz($number);
        $this->assertSame($resultat, $expected);

    }

    public static function fizzbuzzProvider(){
        return [
            "cas 1" => [1 , 1],
            "cas 2" => [2 , 2],
            "cas 3" => [3 , "fizz"],
            "cas 4" => [4 , 4],
            "cas 5" => [5 , "buzz"],
            "cas 6" => [6 , "fizz"],
            "cas 10" => [10 , "buzz"],
            "cas 15" => [15 , "fizzbuzz"],
            "cas 30" => [30 , "fizzbuzz"]
        ];
    }  





    #[DataProvider("palindromeProvider")]
    public function test_palindrome(string $text , string $expected){

        $word = new Word();
        $resultat = $word->palindrome($text);
        $this->assertSame($resultat, $expected);

    }

    public static function palindromeProvider(){
        return [
            "cas 1" => ["kayak" , "True"],
            "cas 2" => ["Hichem" , "False"],
            "cas 3" => ["laval" , "True"],
            "cas 4" => ["02/02/2020" , "True"],
            "cas 5" => ["blabla" , "False"],
            "cas 6" => ["1991" , "True"]
        ];
    }      

}