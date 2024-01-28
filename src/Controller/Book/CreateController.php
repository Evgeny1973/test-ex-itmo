<?php

declare(strict_types=1);

namespace App\Controller\Book;

use App\Model\Book\UseCase\Create\BookCreateCommand;
use App\Model\Book\UseCase\Create\BookCreateHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsController]
final class CreateController
{
    public function __construct(private readonly ValidatorInterface $validator)
    {
    }
    
    #[Route('/book/create', name: 'book_create', methods: [Request::METHOD_POST])]
    public function __invoke(Request $request, BookCreateHandler $handler): JsonResponse
    {
        $command = new BookCreateCommand(
            $request->request->get('title'),
            $request->request->getInt('published'),
            $request->request->get('isbn'),
            $request->request->getInt('pages')
        );
        
        $errors = $this->validator->validate($command);
        if (\count($errors) > 0) {
            return new JsonResponse(['errors' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }
        
        try {
            $handler->handle($command);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        
        return new JsonResponse(['success' => true]);
    }
}
