<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @Route("/admin",name="admin_")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
   public function dashboard ()
   {
       return $this->render('admin/dashboard.html.index');
   }

   /**
    * @Route("/users",name="users")
    */

   public function listUsers(UserRepository $repo)
   {
       $users=$repo->findAll();
       return $this->render('admin/users.html.twig',['users'=>$users]);
   }




}
