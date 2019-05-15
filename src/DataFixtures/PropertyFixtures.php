<?php

namespace App\DataFixtures;
 
use App\Entity\Property;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
 
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
        
 
        // on créé 200 Biens
        for ($i = 0; $i < 200; $i++) {
            $result = new Property();
            $result->setTitle('Bien n° '.$i);
            $result->setDescription($faker->text);
            $result->setSurface($faker->numberBetween($min = 90, $max = 600));
            $result->setRooms($faker->numberBetween($min = 1, $max = 5));
            $result->setBedrooms($faker->numberBetween($min = 2, $max = 4));
            $result->setHeat($faker->randomElement([
                'gaz', 'électrique', 'gaz et électrique', 'N C'
            ]));
            $result->setPrice($faker->numberBetween($min = 17000, $max = 1000000));

            $result->setFloor($faker->numberBetween($min = 0, $max = 10));
            $result->setAddress($faker->streetAddress);
            $result->setCity($faker->city);
            $result->setPostalCode($faker->postcode);
            
            $result->setSold($faker->numberBetween($min = 0, $max =1 ));
            $result->setCreatedAt($faker->dateTimeBetween('-10 days'));
            $manager->persist($result);
        }
 
        $manager->flush();
    }
}