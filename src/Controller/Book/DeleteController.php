<?php

declare(strict_types=1);

namespace App\Controller\Book;

use App\Model\Book\Entity\Book;
use App\Model\Book\UseCase\Delete\BookDeleteCommand;
use App\Model\Book\UseCase\Delete\BookDeleteHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class DeleteController
{
    #[Route('/book/{id}/delete', name: 'book_delete', methods: [Request::METHOD_POST])]
    public function __invoke(Book $book, BookDeleteHandler $handler): JsonResponse
    {
        $command = new BookDeleteCommand($book);
        
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['success' => true]);
    }
}
