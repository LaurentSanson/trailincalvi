<?php

namespace App\EventListener;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Post::class)]
class PostSlugCreator
{
    public function __construct(private readonly SluggerInterface $slugger)
    {
    }

    public function prePersist(Post $post, PrePersistEventArgs $event): void
    {
        $post->setSlug(strtolower($this->slugger->slug((string) $post->getTitle())));
    }
}
