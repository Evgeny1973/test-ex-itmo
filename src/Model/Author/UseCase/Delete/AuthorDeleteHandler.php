<?php

declare(strict_types=1);

namespace App\Model\Author\UseCase\Delete;

use App\Model\Flusher;

final class AuthorDeleteHandler
{
    public function __construct(private readonly Flusher $flusher)
    {
    }
    
    public function handle(AuthorDeleteCommand $command): void
    {
        $command->author->delete();
        
        $this->flusher->flush();
    }
}
