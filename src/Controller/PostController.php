<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/post", name="post.")
     */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();
        
        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request){
        //create a new post with title
        $post = new Post();

        $post->setTitle('This going to be a title');

        //entity manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('Post was created');
    }
}
