<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\Bind;

use App\Model\Author\Entity\Author;
use App\Model\Book\Entity\Book;

final class BindCommand
{
    public function __construct(public readonly Book $book, public readonly Author $author)
    {
    }
}
