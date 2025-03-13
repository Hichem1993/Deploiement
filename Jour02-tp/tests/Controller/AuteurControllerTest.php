<?php

namespace App\Tests\Controller;

use App\Entity\Auteur;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AuteurControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $auteurRepository;
    private string $path = '/auteur/';

    protected function setUp(): void
    {
        // DOM 
        $this->client = static::createClient();

        // Base de données 
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->auteurRepository = $this->manager->getRepository(Auteur::class);

        // vider la table auteur 
        /* foreach ($this->auteurRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush(); */
    }

    public function testIndex(): void
    {

        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path); 
        // symfony serve
        // lance un navigateur 
        //  https://127.0.0.1:8000/auteur


        // 2 assertions 

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Liste des auteurs !!');

        // Use the $crawler to perform additional assertions e.g.

        self::assertSame('Bonjour !!!', $crawler->filter('h1')->first()->innerText());
        self::assertSame('Create new', $crawler->filter('a.new')->first()->innerText());
        // composer test 
    }

    public function testNew(): void
    {
        // $this->markTestIncomplete();
        // aller sur le formulaire de création d'auteur
        $crawler = $this->client->request('GET', sprintf('%snew', $this->path));
        // vérifier qu'elle fonctionne 
        self::assertResponseStatusCodeSame(200);

        self::assertSame('Create new Auteur', $crawler->filter('h1')->first()->innerText());

        $this->client->submitForm('Save', [
            'auteur[prenom]' => 'Alain',
            'auteur[nom]' => 'Dufour',
            'auteur[age]' => 44,
            'auteur[dt_creation]' => '2025-03-11 12:00:00',
        ]);

        // si le formulaire a été rempli correctement 
        // redirigé vers la page contenant le tableau des auteurs 
        self::assertResponseRedirects("/auteur");

        // self::assertSame(1, $this->auteurRepository->count([]));
    }

    private function createAuteurFactice(){
        $id = uniqid();
        $fixture = new Auteur();
        $fixture->setPrenom("Alain $id");
        $fixture->setNom("Dufour $id");
        $fixture->setAge(random_int(10, 50));
        $fixture->setDtCreation(new DateTime());

        $this->manager->persist($fixture);
        $this->manager->flush();
        return $fixture ; 
    }


    public function testShow(): void
    {
        //$this->markTestIncomplete();

        $fixture = $this->createAuteurFactice();
        
        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Auteur');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        // $this->markTestIncomplete();

        $fixture = $this->createAuteurFactice();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);

        $id = uniqid();

        $this->client->submitForm('Update', [
            'auteur[prenom]' => "Céline $id",
            'auteur[nom]' => 'DUFORT',
            'auteur[age]' => 22 ,
        ]);

        self::assertResponseRedirects('/auteur');

        // vérifier que en base base de données il y a un profil 
        $resultat = $this->auteurRepository->findOneBy([ "prenom" => "Céline $id" ]);

        self::assertInstanceOf(Auteur::class, $resultat);
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Auteur();
        $fixture->setPrenom('Value');
        $fixture->setNom('Value');
        $fixture->setAge('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/auteur/');
        self::assertSame(0, $this->auteurRepository->count([]));
    }
}