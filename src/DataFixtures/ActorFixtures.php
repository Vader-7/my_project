<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Actor;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actor = new Actor();
        $actor->setName("Keanu Reeves");
        $manager->persist($actor);

        $actor1 = new Actor();
        $actor1->setName("Laurence Fishburne");
        $manager->persist($actor1);

        $manager->flush();

        $this->addReference("actor", $actor);
        $this->addReference("actor1", $actor1);
    }
}
