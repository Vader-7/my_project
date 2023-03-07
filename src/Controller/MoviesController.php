<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
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

    #[Route("/movies", methods: ['GET'], name: "movies")]
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

    //create a new movie
    #[Route("/movies/create", name: "create_movie")]
    public function create(): Response 
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);

        return $this->render("movies/create.html.twig", [ "form" => $form->createView()
        ]);
    }


    #[Route("/movies/{id}", methods: ['GET'], name: "movie")]
    public function show($id): Response
    {
        $movie = $this->movieRepository->find($id);

        return $this->render("movies/show.html.twig", [ "movie" => $movie]
        );
    }
}
