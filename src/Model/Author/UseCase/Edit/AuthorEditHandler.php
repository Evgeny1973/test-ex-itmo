<?php

declare(strict_types=1);

namespace App\Model\Author\UseCase\Edit;

use App\Model\Author\Entity\AuthorRepository;
use App\Model\Flusher;
use Doctrine\ORM\EntityNotFoundException;

final class AuthorEditHandler
{
    public function __construct(private readonly AuthorRepository $authors, private readonly Flusher $flusher)
    {
    }
    
    public function handle(AuthorEditCommand $command): void
    {
        try {
            $author = $this->authors->get($command->id);
        } catch (EntityNotFoundException $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
        
        $author->edit(
            $command->firstName,
            $command->middleName,
            $command->lastName
        );
        
        $this->flusher->flush();
    }
}
