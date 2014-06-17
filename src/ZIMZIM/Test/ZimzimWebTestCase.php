<?php

namespace ZIMZIM\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ZimzimWebTestCase extends WebTestCase
{
    public $users = array(
        'SuperAdmin' => array(
            'PHP_AUTH_USER' => 'zimzim62000@gmail.com',
            'PHP_AUTH_PW' => '170183'
        )
    );
    public $router;

    public function setUp(){
        parent::setUp();
    }
}