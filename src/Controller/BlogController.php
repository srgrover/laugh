<?php
namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->getLatestBlogs();
        return $this->render('Index/index.html.twig', [
            'posts' => $posts
        ]);
    }





}