<?php

declare(strict_types=1);

namespace App\Model\Book\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ObjectRepository;

final class BookRepository
{
    private EntityManagerInterface $em;
    private ObjectRepository $repo;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Book::class);
    }
    
    public function get(int $id): Book
    {
        if (!$book = $this->repo->find($id)) {
            throw new EntityNotFoundException('Book not found');
        }
        
        return $book;
    }
    
    public function add(Book $book): void
    {
        $this->em->persist($book);
    }
}
