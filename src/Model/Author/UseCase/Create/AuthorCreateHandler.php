<?php

declare(strict_types=1);

namespace App\Model\Author\UseCase\Create;

use App\Model\Author\Entity\Author;
use App\Model\Author\Entity\AuthorRepository;
use App\Model\Flusher;

final class AuthorCreateHandler
{
    public function __construct(private readonly AuthorRepository $authors, private readonly Flusher $flusher)
    {
    }
    
    public function handle(AuthorCreateCommand $command): void
    {
        $author = Author::create(
            $command->firstName,
            $command->middleName,
            $command->lastName
        );
        
        $this->authors->add($author);
        $this->flusher->flush();
    }
}
