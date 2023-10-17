<?php

namespace App\Tests\Entity;

use App\Entity\Media;
use App\Entity\Post;
use App\Tests\AppTestCase;
use App\Tests\Fixtures\PostBuilder;
use DateTime;
use DateTimeImmutable;

class PostTest extends AppTestCase
{
    public function testItCreatesPost(): void
    {
        /** @var Post $post */
        $post = PostBuilder::for($this)->any();

        self::assertNotNull($post->getId());
        self::assertNotNull($post->getTitle());
        self::assertNotNull($post->getSlug());
        self::assertNotNull($post->getContent());
        self::assertNotNull($post->getFeaturedText());
        self::assertFalse($post->isPublished());
        self::assertInstanceOf(DateTimeImmutable::class, $post->getCreatedAt());
        self::assertInstanceOf(DateTime::class, $post->getUpdatedAt());
        self::assertInstanceOf(Media::class, $post->getFeaturedImage());
    }
}
