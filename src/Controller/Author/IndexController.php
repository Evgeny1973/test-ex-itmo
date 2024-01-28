<?php

declare(strict_types=1);

namespace App\Controller\Author;

use App\ReadModel\Author\AuthorFetcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class IndexController
{
    #[Route('/authors/all', name: 'authors_all', methods: [Request::METHOD_GET])]
    public function __invoke(AuthorFetcher $authorFetcher): JsonResponse
    {
        return new JsonResponse(['authors' => $authorFetcher->allAuthors()]);
    }
}
