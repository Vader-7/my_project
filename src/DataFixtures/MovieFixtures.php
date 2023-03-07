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
        $movie->setTitle('The Matrix');
        $movie->setReleaseYear(1999);
        $movie->setDescription('A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.');
        $movie->setImagePath('https://image.tmdb.org/t/p/w500/6u1fYtxG5eqjhtCPDx04pJphQRW.jpg');
        $manager->persist($movie);

        $movie1 = new Movie();
        $movie1->setTitle('The Matrix Reloaded');
        $movie1->setReleaseYear(2003);
        $movie1->setDescription('Neo and the rebel leaders estimate that they have 72 hours until 250,000 probes discover Zion and destroy it and its inhabitants. During this, Neo must decide how he can save Trinity from a dark fate in his dreams.');
        $movie1->setImagePath('https://image.tmdb.org/t/p/w500/3gIO6mCd4Q4PF1tuwcyI3sjFrtI.jpg');
        $manager->persist($movie1);

        
        $manager->flush();
    }
}
