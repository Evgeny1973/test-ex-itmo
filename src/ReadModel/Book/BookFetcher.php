<?php

declare(strict_types=1);

namespace App\ReadModel\Book;

use Doctrine\DBAL\Connection;

final class BookFetcher
{
    public function __construct(private readonly Connection $connection)
    {
    }
    
    public function allBooks(): array
    {
        return $this->connection->createQueryBuilder()
            ->select(
                'id',
                'title',
                'published',
                'isbn',
                'pages'
            )
            ->from('books')
            ->executeQuery()
            ->fetchAllAssociative();
    }
}
