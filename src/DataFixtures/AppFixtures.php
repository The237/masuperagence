<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Option;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setUsername('demo');
        $user->setPassword($this->encoder->encodePassword($user,'secret'));
        
        $manager->persist($user);

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

        $option1 = new Option();
        $option2 = new Option();
        $option3 = new Option();

        $option1->setName('Adapté PMR');
        $option2->setName('Ascenseur');
        $option3->setName('Balcon');
                
        $manager->persist($option1);
        $manager->persist($option2);
        $manager->persist($option3);
        

        $manager->flush();
    }
}
