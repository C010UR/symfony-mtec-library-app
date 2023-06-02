<?php

namespace App\EntityListener;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Utils\FileUtils;

#[AsEntityListener(event: Events::prePersist, entity: Book::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Book::class)]
#[AsEntityListener(event: Events::postRemove, entity: Book::class)]
class BookEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
        private string $dirPublic
    ) {
    }

    public function prePersist(Book $book, LifecycleEventArgs $event): void
    {
        $book->normalizeName();
        $book->computeSlug($this->slugger);
    }

    public function preUpdate(Book $book, PreUpdateEventArgs $event): void
    {
        $book->normalizeName();
        $book->computeSlug($this->slugger);

        if ($event->hasChangedField('imagePath')) {
            FileUtils::unlinkUpload($this->dirPublic, $event->getOldValue('imagePath'));
        }
    }

    public function postRemove(Book $book): void
    {
        FileUtils::unlinkUpload($this->dirPublic, $book->getImagePath());
    }
}
