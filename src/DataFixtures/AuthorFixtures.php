<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Model\Author\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('ru_RU');
        
        for ($i = 0; $i < 10; $i++) {
            $author = Author::create(
                $faker->firstName,
                $faker->lastName,
                $faker->lastName,
            );
            
            $manager->persist($author);
        }
        
        $manager->flush();
    }
}
