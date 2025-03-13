<?php 


namespace App\Controller ;

use App\Entity\Client;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class FrontController extends AbstractController{


    #[Route("/" , name: "page_inscription")]
    public function inscription(
        Request $request ,
        UserPasswordHasherInterface $hasher ,
        EntityManagerInterface $em 
    ){

        $form = $this->createForm(ClientType::class); 

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();
            $client = new Client();
            $client
                ->setPseudo($data->getPseudo())
                ->setEmail($data->getEmail())
                ->setPassword($hasher->hashPassword( $client , $data->getPassword() ))
            ;
            $em->persist($client);
            $em->flush();
            // vider le formulaire 
            $form = $this->createForm(ClientType::class); 
        }

        return $this->render("front/inscription.html.twig", [
            "form" => $form->createView()
        ]);
    }

}