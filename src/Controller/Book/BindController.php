<?php

declare(strict_types=1);

namespace App\Controller\Book;

use App\Model\Author\Entity\Author;
use App\Model\Book\Entity\Book;
use App\Model\Book\UseCase\Bind\BindCommand;
use App\Model\Book\UseCase\Bind\BindHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class BindController
{
    #[Route('/book/{book}/author/{author}/bind', name: 'book_author_bind', methods: [Request::METHOD_POST])]
    public function __invoke(Book $book, Author $author, BindHandler $handler): JsonResponse
    {
        $command = new BindCommand($book, $author);
        
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['success' => true]);
    }
}
