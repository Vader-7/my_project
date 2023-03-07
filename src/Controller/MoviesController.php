<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class MoviesController extends AbstractController
{
    //constructor injection
    private $em;
    private $movieRepository;
    public function __construct(
        MovieRepository $movieRepository,
        EntityManagerInterface $em
    ) {
        $this->movieRepository = $movieRepository;
        $this->em = $em;
    }

    #[Route("/movies", methods: ["GET"], name: "movies")]
    public function index(): Response
    {
        // findAll() movies = SELECT * FROM movie
        // find() movies = SELECT * FROM movie WHERE id = 5
        // findBy() movies = SELECT * FROM movie ORDER BY id DESC
        // findOneBy() movies = SELECT * FROM movie WHERE title = 'The Matrix' LIMIT 1
        // count movies = SELECT COUNT(*) FROM movie WHERE id = 5
        // getClassNames() = Shows the Entity class names
        $movies = $this->movieRepository->findAll();

        return $this->render("movies/index.html.twig", [
            "movies" => $movies,
        ]);
    }

    //create a new movie
    #[Route("/movies/create", name: "create_movie")]
    public function create(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newMovie = $form->getData();

            $imagePath = $form->get("imagePath")->getData();
            if ($imagePath) {
                $newFileName = uniqid() . "." . $imagePath->guessExtension();
                try {
                    $imagePath->move(
                        $this->getParameter("kernel.project_dir") .
                            "/public/uploads",
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $newMovie->setImagePath("/uploads/" . $newFileName);
            }

            $this->em->persist($newMovie);
            $this->em->flush();

            return $this->redirectToRoute("movies");
        }

        return $this->render("movies/create.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    #[Route("/movies/edit/{id}", name: "edit_movie")]
    public function edit($id, Request $request): Response
    {
        $movie = $this->movieRepository->find($id);
        $form = $this->createForm(MovieFormType::class, $movie);
        $form->handleRequest($request);
        $imagePath = $form->get("imagePath")->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($imagePath) {
                if ($movie->getImagePath() !== null || "") {
                    if (
                        file_exists(
                            $this->getParameter("kernel.project_dir") .
                                $movie->getImagePath()
                        )
                    ) {
                        $this->getParameter("kernel.project_dir") .
                            $movie->getImagePath();
                    }

                    $newFName = uniqid() . "." . $imagePath->guessExtension();

                    try {
                        $imagePath->move(
                            $this->getParameter("kernel.project_dir") .
                                "/public/uploads",
                            $newFName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }

                    $movie->setImagePath("/uploads/" . $newFName);
                    $this->em->flush();

                    return $this->redirectToRoute("movies");
                }
            } else {
                $movie->setTitle($form->get("title")->getData());
                $movie->setReleaseYear($form->get("releaseYear")->getData());
                $movie->setDescription($form->get("description")->getData());

                $this->em->flush();
                return $this->redirectToRoute("movies");
            }

            $this->em->persist($movie);
            $this->em->flush();

            return $this->redirectToRoute("movies");
        }

        return $this->render("movies/edit.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    #[Route("/movies/{id}", methods: ["GET"], name: "movie")]
    public function show($id): Response
    {
        $movie = $this->movieRepository->find($id);

        return $this->render("movies/show.html.twig", ["movie" => $movie]);
    }
}
