<?php

declare(strict_types=1);

namespace App\Controller\Author;

use App\Model\Author\UseCase\Edit\AuthorEditCommand;
use App\Model\Author\UseCase\Edit\AuthorEditHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class EditController
{
    #[Route('/author/edit', name: 'author_edit', methods: [Request::METHOD_POST])]
    public function __invoke(
        #[MapRequestPayload]
        AuthorEditCommand $command,
        AuthorEditHandler $handler
    ): JsonResponse {
        
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['success' => true]);
    }
}
