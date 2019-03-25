<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use http\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

///**
// * Class PostController
// * @package App\Controller
// * @Security("is_granted('ROLE_USER')")
// */
class PostController extends AbstractController
{
    /**
     * @Route("/post/add", name="new_post", methods={"GET", "POST"})
     * @Route("/post/edit/{id}", name="edit_post", methods={"GET", "POST"})
     * @param Request $request
     * @param Post|null $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postAction(Request $request, Post $post = null)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        if (null == $post) {
            $post = new Post();
            $em->persist($post);

            $post->setAuthor($this->getUser());
            $post->setCreated(new \Datetime("now"));
        }
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                $this->addFlash('estado', 'Cambios guardados con éxito');
                return $this->redirectToRoute('homepage');
            }
            catch(Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            }
        }
        return $this->render('Post/add_post.html.twig', [
            'post' => $post,
            'formulario' => $form->createView()
        ]);
    }

    /**
     * @Route("/post/{id}", name="view_post", methods={"GET", "POST"})
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewPostAction(Request $request, Post $post)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $views = $post->getViews();
        $post->setViews($views+1);

        try {
            $em->flush();
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }

        $new_comment = new Comment();

        $form_comment = $this->createForm(CommentType::class, $new_comment);
        $form_comment->handleRequest($request);

        if ($form_comment->isSubmitted() && $form_comment->isValid()) {
            try {
                $new_comment->setAuthor($this->getUser());
                $new_comment->setCreated(new \DateTime('now'));
                $new_comment->setApproved(true);
                $new_comment->setPost($post);

                $em->flush();
                $this->addFlash('estado', 'Comentario enviado!');
                return $this->redirectToRoute('view_post', $post);
            }
            catch(Exception $e) {
                $this->addFlash('error', 'No se han podido guardar los cambios');
            } catch (OptimisticLockException $e) {
            } catch (ORMException $e) {
            }
        }

        $comments = $this->getDoctrine()->getRepository(Comment::class)->getCommentsForBlog($post->getId());

        return $this->render('Post/view_post.html.twig', [
            'post' => $post,
            'comments' => $comments,
            'form_comment' => $form_comment->createView(),
        ]);
    }

//    /**
//     * @Route("/post/delete/{id}", name="delete_post", methods={"GET"})
//     */
//    public function borrarAction(Post $post)
//    {
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getManager();
//        return $this->render('alumno/borrar.html.twig', [
//            'alumno' => $post
//        ]);
//    }
//    /**
//     * @Route("/post/delete/{id}", name="confirm_delete_post", methods={"POST"})
//     */
//    public function borrarDeVerdadAction(Post $post)
//    {
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getManager();
//        try {
//            foreach($post->getPartes() as $parte) {
//                $em->remove($parte);
//            }
//            $em->remove($post);
//            $em->flush();
//            $this->addFlash('estado', 'Alumno eliminado con éxito');
//        }
//        catch(Exception $e) {
//            $this->addFlash('error', 'No se han podido eliminar');
//        }
//        return $this->redirectToRoute('listar_alumnado');
//    }


}