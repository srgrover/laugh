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
class FollowController extends AbstractController
{

//    /**
//     * @Route("/follow", name="following_follow", methods="POST")
//     * @param Request $request
//     * @return boolean
//     */
//    public function followAction(Request $request){
//        $user = $this->getUser();                        //Obtenemos el usuario actual
//        $followed_id = $request->get('followed');   //Obtenemos el usuario al que vamos a seguir. 'followed' es una variable recogida por POST
//        $em = $this->getDoctrine()->getManager();
//        $user_repo = $em->getRepository('AppBundle:Usuario');
//        $followed = $user_repo->find($followed_id);
//        $following = new Seguimiento();             //Creamos nueva instancia de la entida seguimiento
//        $following->setUsuario($user);              //Seteamos el usuario seguido
//        $following->setSeguidor($followed);         //Y el usuario seguidor
//        $em->persist($following);
//        $flush = $em->flush();                      //Para que guarde los cambios
//        if($flush == null){                         //Si no da fallo
//            $notificacion = $this->get('app.notificacion_service');
//            $notificacion->set($followed, 'follow', $user->getId(),null,null);
//            $this->addFlash('estado', 'Ahora estas siguiendo a este usuario.');
//        }else{
//            $this->addFlash('error', 'No se ha podido seguir a este usuario');
//        }
//        die();
//    }

}