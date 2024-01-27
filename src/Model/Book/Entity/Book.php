<?php

declare(strict_types=1);

namespace App\Model\Book\Entity;

use App\Model\Author\Entity\Author;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'books')]
#[ORM\UniqueConstraint(name: 'bookTitleIsbn', columns: ['title', 'isbn'])]
#[ORM\UniqueConstraint(name: 'bookTitlePublishedAt', columns: ['title', 'published_at'])]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id;
    
    #[ORM\Column(type: Types::STRING)]
    private string $title;
    
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private \DateTimeInterface $publishedAt;
    
    #[ORM\Column(type: Types::STRING, length: 13)]
    private string $isbn;
    
    #[ORM\Column(type: Types::INTEGER)]
    private int $pages;
    
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $image = null;
    
    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'books')]
    #[ORM\JoinTable(name: 'books_authors')]
    private Collection $authors;
    
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $createdAt;
    
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;
    
    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable('now');
    }
    
    public static function create(string $title, \DateTimeImmutable $publishedAt, string $isbn, int $pages): Book
    {
        $book = new self();
        $book->title = $title;
        $book->publishedAt = $publishedAt;
        $book->isbn = $isbn;
        $book->pages = $pages;
        
        return $book;
    }
    
    public function edit(string $title, \DateTimeImmutable $publishedAt, string $isbn, int $pages): void
    {
        $this->title = $title;
        $this->publishedAt = $publishedAt;
        $this->isbn = $isbn;
        $this->pages = $pages;
    }
    
    public function addAuthor(Author $author): void
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
            $author->addBook($this);
        }
    }
    
    public function removeAuthor(Author $author): void
    {
        if ($this->authors->contains($author)) {
            $this->authors->removeElement($author);
            $author->removeBook($this);
            $this->updatedAt = new \DateTimeImmutable('now');
        }
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
    
    public function getPublishedAt(): \DateTimeInterface
    {
        return $this->publishedAt;
    }
    
    public function getIsbn(): string
    {
        return $this->isbn;
    }
    
    public function getPages(): int
    {
        return $this->pages;
    }
    
    public function getImage(): ?string
    {
        return $this->image;
    }
    
    public function getAuthors(): Collection
    {
        return $this->authors;
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
