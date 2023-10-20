<?php

namespace App\EventListener;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Post::class)]
class PostSlugUpdator
{
    public function __construct(private readonly SluggerInterface $slugger)
    {
    }

    public function preUpdate(Post $post, PreUpdateEventArgs $event): void
    {
        if ($event->hasChangedField('title')) {
            $post->setSlug($this->slugger->slug((string) $event->getNewValue('title'))->lower());
        }
    }
}
