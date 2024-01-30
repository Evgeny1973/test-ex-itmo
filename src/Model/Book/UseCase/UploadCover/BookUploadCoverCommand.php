<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\UploadCover;

use App\Model\Book\Entity\Book;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

final class BookUploadCoverCommand
{
    public function __construct(
        #[Assert\NotNull]
        #[Assert\Image(maxSize: '1M', mimeTypes: ['image/jpeg', 'image/png', 'image/jpg'])]
        public readonly UploadedFile $file,
        #[Assert\NotNull]
        public readonly Book $book,
        #[Assert\NotNull]
        public readonly string $path)
    {
    }
}
