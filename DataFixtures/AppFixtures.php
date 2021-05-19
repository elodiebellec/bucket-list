<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for($i = 0; $i <= 10; $i++){
           $wish = new Wish();
           $wish    ->setTitle("Title".$i)
                    ->setNote(8.1)
               ->setIsPublished(true)
               ->setDescription("Description".$i)
               ->setAuthor("Author".$i)
               ->setDateCreated(new \DateTime());
           $manager->persist($wish);

       }
        $manager->flush();
    }
}
