<?php

namespace App\Tests\Fixtures;

use App\Entity\Media;
use App\Entity\Post;
use App\Tests\AbstractBuilder;

class PostBuilder extends AbstractBuilder
{
    private ?string $title;
    private ?string $content;
    private ?bool $isPublished;
    private ?string $featuredText;
    private ?Media $featuredImage;

    public function withTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function withContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function withFeaturedText(string $featuredText): self
    {
        $this->featuredText = $featuredText;

        return $this;
    }

    public function withFeaturedImage(Media $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function build(bool $persist = true): Post
    {
        $post = new Post();

        $post->setTitle($this->title ?? 'Trail in Calvi is back');
        $post->setContent($this->content ?? 'This is the content for the article');
        $post->setIsPublished($this->isPublished ?? false);
        $post->setFeaturedText($this->featuredText ?? 'This is the featured text for the article');
        $post->setFeaturedImage($this->featuredImage ?? MediaBuilder::for($this->testCase)->any());

        if ($persist) {
            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }

        return $post;
    }

    public function clear(): self
    {
        $this->title = null;
        $this->content = null;
        $this->isPublished = false;
        $this->featuredText = null;
        $this->featuredImage = null;

        return $this;
    }
}
