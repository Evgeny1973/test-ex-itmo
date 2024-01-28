<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Model\Book\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        
        for ($i = 0; $i < 10; $i++) {
            $book = Book::create(
                $faker->sentence,
                (int) $faker->year,
                $faker->isbn13(),
                $faker->numberBetween(10, 500)
            );
         
            $manager->persist($book);
        }
        
        $manager->flush();
    }
}
