<?php
namespace App\Controller;

use App\Entity\User;
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

}