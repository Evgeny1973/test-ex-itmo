<?php

namespace App\Model\Author\Entity;

use App\Model\Book\Entity\Book;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'authors')]
#[ORM\UniqueConstraint(name: 'author', columns: ['first_name', 'middle_name', 'last_name'])]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id;
    
    #[ORM\Column(type: Types::STRING)]
    private string $firstName;
    
    #[ORM\Column(type: Types::STRING)]
    private string $middleName;
    
    #[ORM\Column(type: Types::STRING)]
    private string $lastName;
    
    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'authors')]
    private Collection $books;
    
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;
    
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
    
    public function __construct()
    {
        $this->books = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable('now');
    }
    
    public static function create(string $firstName, string $middleName, string $lastName): Author
    {
        $author = new self();
        $author->firstName = $firstName;
        $author->middleName = $middleName;
        $author->lastName = $lastName;
        
        return $author;
    }
    
    public function edit(string $firstName, string $middleName, string $lastName): void
    {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
    }
    
    public function addBook(Book $book): void
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->addAuthor($this);
            $this->updatedAt = new \DateTimeImmutable('now');
        }
    }
    
    public function removeBook(Book $book): void
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            $book->removeAuthor($this);
        }
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    
    public function getMiddleName(): string
    {
        return $this->middleName;
    }
    
    public function getLastName(): string
    {
        return $this->lastName;
    }
    
    public function getBooks(): Collection
    {
        return $this->books;
    }
    
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
    
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}