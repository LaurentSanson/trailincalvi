<?php

namespace App\Tests\Controller\Admin;

use App\Tests\AppTestCase;
use App\Tests\Fixtures\UserBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardControllerTest extends AppTestCase
{
    public function testItShowsAdminPage(): void
    {
        $user = UserBuilder::for($this)->withRoles('ROLE_ADMIN')->build();
        $this->client->loginUser($user);

        $this->client->request(Request::METHOD_GET, '/admin');

        self::assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}
