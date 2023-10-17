<?php

namespace App\Tests\Controller\Admin;

use App\Controller\Admin\DashboardController;
use App\Controller\Admin\MediaCrudController;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Test\AbstractCrudTestCase;
use Symfony\Component\HttpFoundation\Request;

class MediaCrudControllerTest extends AbstractCrudTestCase
{
    protected function getControllerFqcn(): string
    {
        return MediaCrudController::class;
    }

    protected function getDashboardFqcn(): string
    {
        return DashboardController::class;
    }

    public function testItShowsIndexPage(): void
    {
        $user = new User();
        $user->setEmail('admin29@test.com');
        $user->setPassword('password');
        $user->setRoles(['ROLE_ADMIN']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $this->client->loginUser($user);

        $this->client->request(Request::METHOD_GET, $this->generateIndexUrl());

        static::assertResponseIsSuccessful();
    }
}
