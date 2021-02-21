<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        

        for ($i=1; $i<10 ; $i++) {  
            $property = new Property();
            $property->setTitle('Property '.$i)
            ->setPrice(1000*$i)
            ->setRooms(rand(2,5))
            ->setBedrooms(rand(2,5))
            ->setDescription('Another day in Symfony journey yeah!!!')
            ->setSurface(30*$i)
            ->setFloor($i)
            ->setHeat(1)
            ->setCity("Mbalmayo")
            ->setAdress($i.'Boulevard OWONA Edouard')
            ->setPostalCode(1500*$i)
            
            ;
            $manager->persist($property);
        }
        

        $manager->flush();
    }
}
