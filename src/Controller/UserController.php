<?php
namespace App\Controller;

use App\Entity\User;
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

}