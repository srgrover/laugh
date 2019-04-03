<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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


    /**
     * @Route("/comment/delete/{id}", name="confirm_delete_comment", methods={"GET"})
     * @param Comment $id
     * @return Response
     */
    public function borrarDeVerdadAction(Comment $id)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        try {
            $em->remove($id);
            $em->flush();
            $this->addFlash('estado', 'Comentario eliminado');
        }
        catch(ORMException $e) {
            $this->addFlash('error', 'Ups! Algo salió mal. No se han podido eliminar');
        }
        return $this->redirectToRoute('view_post', array('id' => $id->getPost()->getId()));
    }


}