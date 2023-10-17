<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppTestCase extends WebTestCase
{
    protected KernelBrowser $client;
    protected ContainerInterface $testContainer;
    protected EntityManagerInterface $em;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
        $this->client->catchExceptions(false);
        $this->testContainer = self::getContainer();
        $this->em = self::getContainer()->get('doctrine')->getManager();
    }

    public function container(): ContainerInterface
    {
        return self::getContainer();
    }

    public function debugHtml(): void
    {
        file_put_contents('index.html', $this->client->getResponse()->getContent());
    }
}
