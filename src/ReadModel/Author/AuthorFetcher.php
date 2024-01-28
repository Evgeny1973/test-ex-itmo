<?php

declare(strict_types=1);

namespace App\ReadModel\Author;

use Doctrine\DBAL\Connection;

final class AuthorFetcher
{
    public function __construct(private readonly Connection $connection)
    {
    }
    
    public function allAuthors(): array
    {
        return $this->connection->createQueryBuilder()
            ->select(
                'id',
                'TRIM(CONCAT(first_name, \' \', middle_name, \' \', last_name)) AS author'
            )
            ->from('authors')
            ->executeQuery()
            ->fetchAllAssociative();
    }
}
