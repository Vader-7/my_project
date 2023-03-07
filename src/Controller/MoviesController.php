<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    //constructor injection
    private $movieRepository;
    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    #[Route("/movies", name: "movies")]
    public function index(): Response
    {
        // findAll() movies = SELECT * FROM movie
        // find() movies = SELECT * FROM movie WHERE id = 5
        // findBy() movies = SELECT * FROM movie ORDER BY id DESC
        // findOneBy() movies = SELECT * FROM movie WHERE title = 'The Matrix' LIMIT 1
        // count movies = SELECT COUNT(*) FROM movie WHERE id = 5
        // getClassNames() = Shows the Entity class names
        $movies = $this->movieRepository->findAll();

        return $this->render("movies/index.html.twig", array(
            "movies" => $movies
        ));
    }
}
