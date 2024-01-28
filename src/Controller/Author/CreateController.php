<?php

declare(strict_types=1);

namespace App\Controller\Author;

use App\Model\Author\UseCase\Create\AuthorCreateCommand;
use App\Model\Author\UseCase\Create\AuthorCreateHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class CreateController
{
    #[Route('/author/create', name: 'author_create', methods: [Request::METHOD_POST])]
    public function __invoke(
        #[MapRequestPayload]
        AuthorCreateCommand $command,
        AuthorCreateHandler $handler
    ): JsonResponse {
        
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['success' => true]);
    }
}
