<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\Edit;

use App\Model\Book\Entity\BookRepository;
use App\Model\Flusher;
use Doctrine\ORM\EntityNotFoundException;

final class BookEditHandler
{
    public function __construct(private readonly BookRepository $books, private readonly Flusher $flusher)
    {
    }
    
    public function handle(BookEditCommand $command): void
    {
        try {
            $book = $this->books->get($command->id);
        } catch (EntityNotFoundException $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
        
        $book->edit(
            $command->title,
            $command->published,
            $command->isbn,
            $command->pages
        );
        
        $this->flusher->flush();
    }
}
