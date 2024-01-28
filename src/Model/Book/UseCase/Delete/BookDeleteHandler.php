<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\Delete;

use App\Model\Flusher;

final class BookDeleteHandler
{
    public function __construct(private readonly Flusher $flusher)
    {
    }
    
    public function handle(BookDeleteCommand $command): void
    {
        $command->book->delete();
        
        $this->flusher->flush();
    }
}
