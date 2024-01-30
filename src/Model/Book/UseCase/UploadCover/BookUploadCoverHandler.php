<?php

declare(strict_types=1);

namespace App\Model\Book\UseCase\UploadCover;

use App\Model\Flusher;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class BookUploadCoverHandler
{
    public function __construct(private readonly Flusher $flusher)
    {
    }
    
    public function handle(BookUploadCoverCommand $command): void
    {
        $fileName = md5(uniqid()) . '.' . $command->file->getClientOriginalExtension();
        
        try {
            $command->file->move($command->path, $fileName);
        } catch (FileException $e) {
            throw new FileException($e->getMessage());
        }
        
        $command->book->attachCover($fileName);
        
        $this->flusher->flush();
    }
}
