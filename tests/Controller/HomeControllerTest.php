<?php

namespace App\Tests\Controller;

use App\Tests\AppTestCase;
use Symfony\Component\HttpFoundation\Request;

class HomeControllerTest extends AppTestCase
{
    public function testItShowsHomePage(): void
    {
        $this->client->request(Request::METHOD_GET, '/');

        self::assertResponseIsSuccessful();
    }
}
