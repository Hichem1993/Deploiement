<?php

namespace App\Tests\Controller;

use App\Entity\Auteur;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\Date;

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

        // BDD
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->auteurRepository = $this->manager->getRepository(Auteur::class);

        // Vider la table auteur
        /*foreach ($this->auteurRepository->findAll() as $object) {
            $this->manager->remove($object);
        }*/

        $this->manager->flush();
    }




    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);  // symfony serve et clique sur : http://127.0.0.1:8000/auteur

        // 2 assertions
        // Vérifier quelle fonctionne
        self::assertResponseStatusCodeSame(200);

        self::assertPageTitleContains('Auteur index');

        // Vérifier H1
        self::assertSame('Bonjour !!!', $crawler->filter('h1')->first()->innerText());

        // Vérifier lien a
        self::assertSame('Create new', $crawler->filter('a')->first()->innerText());
    }




    public function testNew(): void
    {
        // $this->markTestIncomplete();

        $crawler = $this->client->request('GET', sprintf('%snew', $this->path));  // http://127.0.0.1:8000/auteur/new
        // Vérifier quelle fonctionne
        self::assertResponseStatusCodeSame(200);

        // Vérifier H1
        self::assertSame('Create new Auteur', $crawler->filter('h1')->first()->innerText());


        $this->client->submitForm('Save', [
            'auteur[prenom]' => 'Alain',
            'auteur[nom]' => 'Dufaur',
            'auteur[age]' => 44,
            'auteur[dt_creation]' => '2025-03-11',
        ]);

        // Si le formulaire a été rempli correctement, Redirigé vers la page contenant le tableau des auteurs
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

        return $fixture;
    }


    public function testShow(): void
    {
        // $this->markTestIncomplete();

        $fixture = $this->createAuteurFactice();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Auteur');

        // Use assertions to check that the properties are properly displayed.
    }




    public function testEdit(): void
    {
        //$this->markTestIncomplete();
        $fixture = $this->createAuteurFactice();

        self::assertResponseStatusCodeSame(200);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $id = uniqid();
        $this->client->submitForm('Update', [
            'auteur[prenom]' => "Céline $id",
            'auteur[nom]' => 'Dufort',
            'auteur[age]' => '22',
        ]);

        self::assertResponseRedirects('/auteur');

        // Vérifier en BDD avec ces informations :
        $fixture = $this->auteurRepository->findOneBy(["prenom" => "Céline $id"]);

        self::assertSame("Céline $id", $fixture[0]->getPrenom());
        self::assertSame('Dufor', $fixture[0]->getNom());
        self::assertSame('22', $fixture[0]->getAge());
    }




    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Auteur();
        $fixture->setPrenom('Value');
        $fixture->setNom('Value');
        $fixture->setAge('Value');
        $fixture->setDt_creation('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/auteur/');
        self::assertSame(0, $this->auteurRepository->count([]));
    }
}