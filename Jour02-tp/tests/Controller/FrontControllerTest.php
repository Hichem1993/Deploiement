<?php

use App\Entity\Client;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerTest extends WebTestCase{

    private KernelBrowser $client ;
    private EntityManagerInterface $manager ;
    private EntityRepository $clientRepository ;

    protected function setUp(): void
    {
        // Kernel Browser
        $this->client = static::createClient();
        // acces à la base de données
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->clientRepository = $this->manager->getRepository(Client::class);

    }


    public function test_inscription(){

        // ouvrir la page et elle fonctionne 
        $this->client->request("GET" , "/") ; // ouvrir la page d'accueil du site
        
        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains("page d'inscription"); 

        // remplir le formulaire avec des données valides 

        for($i = 0 ; $i < 2 ; $i++ ){
            $unique = "Alain" . uniqid();

            $this->client->submitForm("créer un profil client" , [
                "client[pseudo]" => $unique,
                "client[email]" => "a@yahoo.fr",
                "client[password]" => "Azerty1234!"
            ]);

            // verifique que il y a bien un profil en base de données avec ayant ce profil 
            $client = $this->clientRepository->findOneBy(["pseudo" => $unique]);

            self::assertNotEmpty($client); // je verifie qu'il y a bien un utilisateur en base de données
        }
        

        // supprimer ce compte factice 

       /*  $this->manager->remove($client);
        $this->manager->flush(); */
    }


}