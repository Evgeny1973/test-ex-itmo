<?php

declare(strict_types=1);

namespace App\Model\Author\UseCase\Delete;

use App\Model\Author\Entity\Author;

final class AuthorDeleteCommand
{
    public function __construct(public readonly Author $author)
    {
    }
}
