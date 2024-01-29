<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\Bind;

use App\Model\Flusher;

final class BindHandler
{
    public function __construct(private readonly Flusher $flusher)
    {
    }
    
    public function handle(BindCommand $command): void
    {
        $command->book->addAuthor($command->author);
        
        $this->flusher->flush();
    }
}
