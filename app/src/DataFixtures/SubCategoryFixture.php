<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SubCategoryFixture extends Fixture implements FixtureGroupInterface
{
    private $faker;

    public function __construct() {

        $this->faker = Factory::create();
    }

    public static function getGroups(): array
    {
        return ['sub_category'];
    }

    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getSubCategory($manager));
        }
        $manager->flush();
    }

    private function getSubCategory(ObjectManager $manager) {

        return new SubCategory(
            $this->faker->name(),
            $this->faker->DateTime(),
            $this->faker->DateTime(),
            $manager->getRepository(Category::class)->find($this->faker->numberBetween(1, 50))
        );
    }
}
