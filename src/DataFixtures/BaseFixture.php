<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;

Abstract class BaseFixture extends Fixture
{
    protected static function getFaker(): Generator
    {
        return Factory::create();
    }
}