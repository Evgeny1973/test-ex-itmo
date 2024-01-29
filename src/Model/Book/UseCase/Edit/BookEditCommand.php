<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\Edit;

use Symfony\Component\Validator\Constraints as Assert;

final class BookEditCommand
{
    public function __construct(
        #[Assert\NotBlank(message: 'Book id cannot be empty')]
        public readonly int $id,
        #[Assert\NotBlank(message: 'Please set book title')]
        public readonly string $title,
        #[Assert\Length(min: 4, max: 4)]
        public readonly int $published,
        #[Assert\Isbn(message: 'This value {{ value }} is neither a valid ISBN-10 nor a valid ISBN-13')]
        public readonly string $isbn,
        #[Assert\Positive(message: 'Pages must be > 0')]
        public readonly int $pages
    ) {
    }
}
