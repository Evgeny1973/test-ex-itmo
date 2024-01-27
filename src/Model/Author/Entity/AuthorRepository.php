<?php

declare(strict_types=1);

namespace App\Model\Author\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ObjectRepository;

final class AuthorRepository
{
    private EntityManagerInterface $em;
    private ObjectRepository $repo;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Author::class);
    }
    
    public function get(int $id): Author
    {
        if (!$author = $this->repo->find($id)) {
            throw new EntityNotFoundException('Author not found');
        }
        
        return $author;
    }
    
    public function add(Author $author): void
    {
        $this->em->persist($author);
    }
    
    public function remove(Author $author): void
    {
    
    }
}
