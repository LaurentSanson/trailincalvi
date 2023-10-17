<?php

namespace App\Tests\Entity;

use App\Entity\Media;
use App\Tests\AppTestCase;
use App\Tests\Fixtures\MediaBuilder;

class MediaTest extends AppTestCase
{
    public function testItCreatesMedia(): void
    {
        /** @var Media $media */
        $media = MediaBuilder::for($this)->any();

        self::assertNotNull($media->getId());
        self::assertNotNull($media->getName());
        self::assertNotNull($media->getFilename());
        self::assertNotNull($media->getAltText());
    }
}
