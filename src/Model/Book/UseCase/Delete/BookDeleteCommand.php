<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\Delete;

use App\Model\Book\Entity\Book;

final class BookDeleteCommand
{
    public function __construct(public readonly Book $book)
    {
    }
}
