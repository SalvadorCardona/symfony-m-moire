<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Module\Book\Todo;
use Doctrine\Persistence\ObjectManager;

class TodoFixtureAbstract extends AbstractBaseFixture
{
    public function __construct()
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = self::getFaker();

        for ($i = 0; $i < 5; ++$i) {
            $todo = new Todo();
            $todo->content = $faker->realText($faker->numberBetween(50, 100));

            $manager->persist($todo);
        }

        $manager->flush();
    }
}
