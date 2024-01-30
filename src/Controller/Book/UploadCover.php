<?php

declare(strict_types=1);

namespace App\Controller\Book;

use App\Model\Book\Entity\Book;
use App\Model\Book\UseCase\UploadCover\BookUploadCoverCommand;
use App\Model\Book\UseCase\UploadCover\BookUploadCoverHandler;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class UploadCover
{
    #[Route('/book/{book}/cover/upload', name: 'book_cover_upload', methods: [Request::METHOD_POST])]
    public function __invoke(
        Request $request,
        Book $book,
        BookUploadCoverHandler $handler,
        #[Autowire(env: 'BOOK_COVER_PATH')]
        string $path
    ): JsonResponse {
        $command = new BookUploadCoverCommand(
            $request->files->get('cover'),
            $book,
            $path
        );
        
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['success' => true]);
    }
}
