<?php

namespace App\Tests\Controller;

use App\Entity\Post;
use App\Tests\AppTestCase;
use App\Tests\Fixtures\PostBuilder;
use Symfony\Component\HttpFoundation\Request;

class PostControllerTest extends AppTestCase
{
    public function testItShowsPostPage(): void
    {
        $this->client->request(Request::METHOD_GET, '/actualites');

        self::assertResponseIsSuccessful();
    }

    public function testItShowsDetailPage(): void
    {
        /** @var Post $post */
        $post = PostBuilder::for($this)->any();

        $this->client->request(Request::METHOD_GET, '/actualites/' . $post->getSlug());

        self::assertResponseIsSuccessful();
    }
}
