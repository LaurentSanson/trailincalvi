<?php

namespace App\Tests\Controller;

use App\Tests\AppTestCase;
use App\Tests\Fixtures\UserBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends AppTestCase
{
    public function testItShowsLoginPage(): void
    {
        $this->client->request(Request::METHOD_GET, '/se-connecter');

        self::assertResponseIsSuccessful();
    }

    public function testItLoginUser(): void
    {
        $user = UserBuilder::for($this)->build();

        $crawler = $this->client->request(Request::METHOD_GET, '/se-connecter');
        $form = $crawler->filter('form[name=login]')->form([
            '_username' => $user->getEmail(),
            '_password' => $user->getPassword(),
        ]);
        $this->client->submit($form);

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}