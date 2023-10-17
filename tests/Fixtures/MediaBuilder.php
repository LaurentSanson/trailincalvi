<?php

namespace App\Tests\Fixtures;

use App\Entity\Media;
use App\Tests\AbstractBuilder;

class MediaBuilder extends AbstractBuilder
{
    private ?string $name;
    private ?string $filename;
    private ?string $altText;

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function withAltText(string $altText): self
    {
        $this->altText = $altText;

        return $this;
    }

    public function build(bool $persist = true): Media
    {
        $media = new Media();

        $media->setName($this->name ?? 'Super photo');
        $media->setFilename($this->filename ?? '/img/super-photo.png');
        $media->setAltText($this->altText ?? 'Super photo');

        if ($persist) {
            $this->entityManager->persist($media);
            $this->entityManager->flush();
        }

        return $media;
    }

    public function clear(): self
    {
        $this->name = null;
        $this->filename = null;
        $this->altText = null;

        return $this;
    }
}
