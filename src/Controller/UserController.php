<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use http\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

///**
// * Class PostController
// * @package App\Controller
// * @Security("is_granted('ROLE_USER')")
// */
class UserController extends AbstractController
{


    /**
     * @Route("/users", name="list_users", methods={"GET", "POST"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function listUsersAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->getAllUsers();

        return $this->render('User/list_users.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/{username}", name="profile")
     * @param Request $request
     * @param null $username
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function perfilAction(Request $request, $username = null){
        /** @var EntityManager $em*/
        $em = $this->getDoctrine()->getManager();
        if($username != null){
            $usuario_repo = $em->getRepository('App\Entity\User');
            $usuario = $usuario_repo->findOneBy(array('username' => $username));
        }else{
            $usuario = $this->getUser();
        }
        //Si el usuario está vacío o no está logueado se redirige al inicio
        if(empty($usuario) || !is_object($usuario)){
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('User/profile.html.twig', [
            'user'  => $usuario
        ]);
    }

    /**
     * @Route("/user/{username}/settings", name="profile_settings")
     * @param Request $request
     * @param null $username
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function perfilSetingsAction(Request $request, $username = null){
        /** @var EntityManager $em*/




        $em = $this->getDoctrine()->getManager();
        if($username != null){
            $usuario_repo = $em->getRepository('App\Entity\User');
            $usuario = $usuario_repo->findOneBy(array('username' => $username));
        }else{
            $usuario = $this->getUser();
        }

        if($usuario != $this->getUser()){
            return $this->redirect($this->generateUrl('forbidden'));
        }

        //Si el usuario está vacío o no está logueado se redirige al login
        if(empty($usuario) || !is_object($usuario)){
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        $form = $this->createForm(ProfileType::class, $usuario);  //Crea el formulario
        $form->handleRequest($request);    //Informacion de request se guarda aqui


        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->persist($usuario);
                $em->flush();
                $this->addFlash('estado', 'Los cambios se han guardado');
                return $this->redirectToRoute('profile', array('username' => $usuario->getUsername()));
            }
            catch (ORMException $e) {
                $this->addFlash('error', 'Ups!. Algo ha salido mal. Intentalo de nuevo mas tarde.');
            }
        }

        return $this->render('User/profile_settings.html.twig', [
            'user'  => $usuario,
            'form' => $form->createView()
        ]);
    }

}