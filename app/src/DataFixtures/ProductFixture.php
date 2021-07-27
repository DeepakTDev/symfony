<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixture extends Fixture implements FixtureGroupInterface
{
    private $faker;

    public function __construct() {

        $this->faker = Factory::create();
    }

    public static function getGroups(): array
    {
        return ['product'];
    }

    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 50; $i++) {
            $manager->persist($this->getProduct($manager));
        }
        $manager->flush();
    }

    private function getProduct(ObjectManager $manager) {

        return new Product(
            $this->faker->name(),
            $this->faker->DateTime(),
            $this->faker->DateTime(),
            $manager->getRepository(Category::class)->find($this->faker->numberBetween(1, 50)),
            $manager->getRepository(SubCategory::class)->find($this->faker->numberBetween(1, 50))
        );
    }
}
