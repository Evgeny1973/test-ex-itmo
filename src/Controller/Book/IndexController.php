<?php

declare(strict_types=1);

namespace App\Controller\Book;

use App\ReadModel\Book\BookFetcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class IndexController
{
    #[Route('/books/all', name: 'books_all', methods: [Request::METHOD_GET])]
    public function __invoke(BookFetcher $bookFetcher): JsonResponse
    {
        return new JsonResponse(['books' => $bookFetcher->allBooks()]);
    }
}
