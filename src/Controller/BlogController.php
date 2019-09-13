<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/forbidden", name="forbidden")
     */
    public function forbidden()
    {

        return $this->render('Access/forbidden.html.twig', [
        ]);
    }

    /**
     * @Route("/comment/delete/{id}", name="confirm_delete_comment", methods={"GET"})
     * @param Comment $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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

    /**
     * @Route("/search", name="search", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function buscarAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $clave = trim($request->query->get("s", null));

        if ($clave != null){
            $usuarios = $em->createQueryBuilder()
                ->select('u')
                ->from('App\Entity\User','u')
                ->where('u.name LIKE :s')
                ->setParameter('s', '%clave%')
                ->getQuery()
                ->getResult();
        } else {
            $this->addFlash('error', 'No puedes buscar si no escribes al menos una palabra');
            return $this->redirectToRoute('homepage');
        }


        return $this->render('Index/search.html.twig', [
            'users' => $usuarios,
        ]);
    }
}