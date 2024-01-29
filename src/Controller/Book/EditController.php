<?php

declare(strict_types=1);

namespace App\Controller\Book;

use App\Model\Book\UseCase\Edit\BookEditCommand;
use App\Model\Book\UseCase\Edit\BookEditHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class EditController
{
    #[Route('/book/edit', name: 'book_edit', methods: [Request::METHOD_POST])]
    public function __invoke(
        #[MapRequestPayload]
        BookEditCommand $command,
        BookEditHandler $handler
    ): JsonResponse {
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['success' => true]);
    }
}
