<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{   
    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {
        $movies = ["Avengers: Endgame", "The Dark Knight", "The Godfather", "The Shawshank Redemption", "The Lord of the Rings: The Return of the King", "Pulp Fiction", "Schindler's List", "Inception", "Fight Club", "The Matrix"];
        return $this->render('movies/index.html.twig', array(
            'movies' => $movies,
        ));
    }    
}
