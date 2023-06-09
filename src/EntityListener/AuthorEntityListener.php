<?php

namespace App\EntityListener;

use App\Entity\Author;
use App\Utils\FileUtils;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: Author::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Author::class)]
#[AsEntityListener(event: Events::postRemove, entity: Author::class)]
class AuthorEntityListener
{
    public function __construct(
        private readonly SluggerInterface $slugger,
        private readonly string $dirPublic
    ) {
    }

    public function prePersist(Author $author, LifecycleEventArgs $event): void
    {
        $author->normalizeName();
        $author->computeSlug($this->slugger);
    }

    public function preUpdate(Author $author, PreUpdateEventArgs $event): void
    {
        $author->normalizeName();
        $author->computeSlug($this->slugger);

        if ($event->hasChangedField('imagePath')) {
            FileUtils::unlinkUpload($this->dirPublic, $event->getOldValue('imagePath'));
        }
    }

    public function postRemove(Author $author): void
    {
        FileUtils::unlinkUpload($this->dirPublic, $author->getImagePath());
    }
}
