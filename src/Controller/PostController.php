<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/actualites', name: 'post_index')]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAllPublished(),
        ]);
    }

    #[Route('/actualites/{slug}', name: 'post_detail')]
    public function detail(Post $post): Response
    {
        return $this->render('post/detail.html.twig', [
            'post' => $post,
        ]);
    }
}
