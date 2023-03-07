<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle("The Matrix");
        $movie->setReleaseYear(1999);
        $movie->setDescription(
            "A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers."
        );
        $movie->setImagePath(
            "https://images.unsplash.com/photo-1641545423876-3d7dc842132c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=3043&q=80"
        );
        $movie->addActor($this->getReference("actor"));
        $movie->addActor($this->getReference("actor1"));
        $manager->persist($movie);

        $movie1 = new Movie();
        $movie1->setTitle("The Matrix Reloaded");
        $movie1->setReleaseYear(2003);
        $movie1->setDescription(
            "Neo and the rebel leaders estimate that they have 72 hours until 250,000 probes discover Zion and destroy it and its inhabitants. During this, Neo must decide how he can save Trinity from a dark fate in his dreams."
        );
        $movie1->setImagePath(
            "https://images.unsplash.com/photo-1640388397643-cd924ab7ef1b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2797&q=80"
        );
        $movie1->addActor($this->getReference("actor"));
        $movie1->addActor($this->getReference("actor1"));
        $manager->persist($movie1);

        $manager->flush();
    }
}
