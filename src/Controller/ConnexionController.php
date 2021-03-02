<?php

namespace App\Controller;


use Doctrine\ORM\EntityManager;
use phpDocumentor\Reflection\Types\Integer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ConnexionController extends AbstractController
{
    /**
     *@Route("/",name="accueil")
     */
    public function index():Response
    {

        return $this->render('index.html.twig');
    }



    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
            return $this->redirectToRoute('accueil');
        return $this->render('connexion/login.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {

    }


    /**
     * @Route ("/inscription", name="inscription")
     *
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $encoder)
    {


      $em=$this->getDoctrine()->getManager();
        $user=new User();
        $form = $this->createForm(InscriptionType::class,$user)
        ->add('Inscription',SubmitType::class,['attr'=>['class'=>'btn_3']]);

        $form->handleRequest($request);
            if (  $form->isSubmitted() && $form->isValid()  )
            {
                $hash=$encoder->encodePassword($user,$user->getPassword());
                $user->setPassword($hash);
                $user->setRoles(['ROLE_USER']);
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute('login');
            }


        return $this->render('connexion/inscription.html.twig',['form'=>$form->createView()]);
    }


    /**
     * @Route ("/terminer_inscription", name="connexion_terminer_inscription")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function terminer_inscription(Request $request,UserPasswordEncoderInterface $encoder)
    {

        $email= $this->getUser()->getEmail();
        $user=$this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$email]);

        $form= $this->createFormBuilder($user,['data_class'=>User::class])
            ->add('cin',NumberType::class)
            ->add('password',PasswordType::class)
            ->add('confirm_password',PasswordType::class)
            ->add('C\'est parti',SubmitType::class,array(
                'attr'=>array('class'=>'btn_3')
            ))->getForm();

        $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid())
      {
          $hash=$encoder->encodePassword($user,$user->getPassword());
          $user->setPassword($hash);
          $em=$this->getDoctrine()->getManager();
          $em->flush();
          return $this->redirectToRoute('accueil');
      }

    return $this->render('connexion/terminer_inscription.html.twig',['form'=>$form->createView()]);

    }



}
