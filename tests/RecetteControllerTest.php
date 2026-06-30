<?php
namespace App\Tests;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RecetteControllerTest extends WebTestCase
{
    public function testListPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/recette/');
        $this->assertResponseIsSuccessful();
    }

    public function testCreateRecettePageRequiresLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/recette/creer');
        $this->assertResponseRedirects('/login');
    }

    public function testDetailPageNotFoundReturns404(): void
    {
        $client = static::createClient();
        $client->request('GET', '/recette/999999');
        $this->assertResponseStatusCodeSame(404);
    }
}
