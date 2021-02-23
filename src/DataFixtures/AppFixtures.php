<?php

namespace App\DataFixtures;

use App\Entity\Option;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i<100 ; $i++) {  
            $faker = Factory::create('en_GB');

            $property = new Property();

            $property
            ->setTitle(ucfirst($faker->words(3,true)))
            ->setPrice($faker->numberBetween(10000,1000000))
            ->setRooms($faker->numberBetween(2,10))
            ->setBedrooms($faker->numberBetween(2,9))
            ->setDescription(ucfirst($faker->sentences(3,true)))
            ->setSurface($faker->numberBetween(20,400))
            ->setFloor($faker->numberBetween(0,15))
            ->setHeat($faker->numberBetween(0,count(Property::HEAT)-1))
            ->setCity(ucfirst($faker->city))
            ->setAdress(ucfirst($faker->address))
            ->setSold(false)
            ->setPostalCode($faker->postcode)
            ;
            
            $manager->persist($property);
        }


        /*for ($i=0; $i<10 ; $i++) {  
            $faker = Factory::create('en_GB');

            $option = new Option();

            $option
            ->setName(ucfirst($faker->words(3,true)))
            ;
            
            $manager->persist($option);
        }*/
        

        $manager->flush();
    }
}
