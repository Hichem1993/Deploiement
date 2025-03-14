<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RecetteController extends AbstractController{

    // http://127.0.0.1:8000/
    // http://127.0.0.1:8000/?id=1
    #[Route("/" , name: "json_all_recettes")]
    public function getAll(
        Request $request
    ){
        $recettes = [
            [
                "id" => 1,
                "nom" => "Crêpe fromage",
                "prix" => 2,
                "ingredients" => ["oeuf", "lait" , "beurre"],
                "image" => "https://placehold.co/600x400?text=Crêpe"
            ],
            [
                "id" => 2,
                "nom" => "Pizza",
                "prix" => 5,
                "ingredients" => ["tomate", "poivron"],
                "image" => "https://placehold.co/600x400?text=Pizza"
            ]
        ];

        $id = $request->query->get("id", null);

        if ($id) {
            $recettes = array_filter($recettes, function($recette) use ($id){
                return $recette["id"] == $id;
            });
        }
        
        return new JsonResponse($recettes , 200, [
            // Erreur CROS
            "Access-Control-Allow-Origin" => "*"
        ]);
    }

}