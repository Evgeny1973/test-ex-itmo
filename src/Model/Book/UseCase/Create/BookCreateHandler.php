<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\Create;

use App\Model\Book\Entity\Book;
use App\Model\Book\Entity\BookRepository;
use App\Model\Flusher;

final class BookCreateHandler
{
    public function __construct(private readonly BookRepository $books, private readonly Flusher $flusher)
    {
    }
    
    public function handle(BookCreateCommand $command): void
    {
        $book = Book::create(
            $command->title,
            $command->published,
            $command->isbn,
            $command->pages
        );
        
        $this->books->add($book);
        $this->flusher->flush();
    }
}
