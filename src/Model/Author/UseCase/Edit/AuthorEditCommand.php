<?php

declare(strict_types=1);

namespace App\Model\Author\UseCase\Edit;

use Symfony\Component\Validator\Constraints as Assert;

final class AuthorEditCommand
{
    public function __construct(
        #[Assert\NotBlank(message: 'Author id cannot be empty')]
        public readonly int $id,
        #[Assert\NotBlank(message: 'Please set first name')]
        public readonly string $firstName,
        #[Assert\NotBlank(message: 'Please set middle name')]
        public readonly string $middleName,
        #[Assert\NotBlank(message: 'Please set last name')]
        public readonly string $lastName
    ) {
    }
}
