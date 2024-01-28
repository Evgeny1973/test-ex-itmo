<?php

declare(strict_types=1);

namespace App\Controller\Author;

use App\Model\Author\Entity\Author;
use App\Model\Author\UseCase\Delete\AuthorDeleteCommand;
use App\Model\Author\UseCase\Delete\AuthorDeleteHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class DeleteController
{
    #[Route('/author/{id}/delete', name: 'author_delete', methods: [Request::METHOD_POST])]
    public function __invoke(Author $author, AuthorDeleteHandler $handler): JsonResponse
    {
        $command = new AuthorDeleteCommand($author);
        
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['success' => true]);
    }
}
