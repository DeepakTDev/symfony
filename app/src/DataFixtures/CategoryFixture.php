<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixture extends Fixture implements FixtureGroupInterface
{
    private $faker;

    public function __construct() {

        $this->faker = Factory::create();
    }

    public static function getGroups(): array
    {
         return ['category'];
    }

    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getCategory());
        }
        $manager->flush();
    }

    private function getCategory() {

        return new Category(
            $this->faker->name(),
            $this->faker->DateTime(),
            $this->faker->DateTime()
        );
    }
}
