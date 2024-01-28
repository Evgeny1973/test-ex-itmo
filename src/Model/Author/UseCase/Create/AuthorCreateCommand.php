<?php

declare(strict_types=1);

namespace App\Model\Author\UseCase\Create;

use Symfony\Component\Validator\Constraints as Assert;

final class AuthorCreateCommand
{
    public function __construct(
        #[Assert\NotBlank(message: 'Please set first name')]
        public readonly string $firstName,
        #[Assert\NotBlank(message: 'Please set middle name')]
        public readonly string $middleName,
        #[Assert\NotBlank(message: 'Please set last name')]
        public readonly string $lastName
    ) {
    }
}
