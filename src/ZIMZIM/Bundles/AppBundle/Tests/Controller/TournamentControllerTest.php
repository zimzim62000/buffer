<?php

namespace ZIMZIM\Bundles\AppBundle\Tests\Controller;

use ZIMZIM\Test\ZimzimWebTestCase;

class TournamentControllerTest extends ZimzimWebTestCase
{
    public $client;
    public $router;

    public function setUp()
    {
        $this->client = static::createClient(array(), $this->users['SuperAdmin']);
        $this->router = $this->client->getContainer()->get('router');
    }

    public function testIndex()
    {
        $route = $this->router->generate('zimzim_bundles_app_tournament');
        $crawler = $this->client->request('GET', $route);
        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET " . $route
        );
    }

    public function testShow()
    {
        $route = $this->router->generate('zimzim_bundles_app_tournament_show', array('id' => 1));
        $crawler = $this->client->request('GET', $route);
        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET " . $route
        );
    }

    public function testNew()
    {
        $route = $this->router->generate('zimzim_bundles_app_tournament_new');
        $crawler = $this->client->request('GET', $route);
        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET " . $route
        );
    }

    public function testEdit()
    {
        $route = $this->router->generate('zimzim_bundles_app_tournament_edit', array('id' => 1));
        $crawler = $this->client->request('GET', $route);
        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET " . $route
        );
    }
}
