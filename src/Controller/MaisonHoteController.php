<?php

namespace App\Controller;

use App\Entity\MaisonHote;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class MaisonHoteController extends AbstractController
{
 /**
     * @Route("/maison_hote", name="maison_hote_list")
  */
 public function index(): Response
 {

    $maison = $this->getDoctrine()->getRepository(MaisonHote::class)->findall();
     
    return $this->render('maison_hote/index.html.twig', ['maisons'=>$maison]);
 }

 

 /**
    * @Route("/maison_hote/{id}/edit", name="edit_maison_hote") 
    * @Route("/maison_hote/new", name="new_maison_hote")
     * Method({"GET","POST"})
  */
public function new(MaisonHote $maison=null,Request $request)
{
    if(!$maison){
        $maison = new MaisonHote();    
    }
    

    $form = $this->createFormBuilder($maison)
    ->add('localisation',TextType::class,array('attr'=>array('class'=>'form-controle')))
    ->add('description',TextareaType::class,array('attr'=>array('class'=>'form-controle')))
    ->add('type',ChoiceType::class,[

        'choices'  => [
            'choose'=>null,
            'villa'=>true,
            'appartement'=>true,
            'maison ' =>true
        ],

    ])
    ->add('nombre_chambres',IntegerType::class,array('attr'=>array('class'=>'form-controle')))
    ->add('image', FileType::class, [
        'label' => 'image',

        // unmapped means that this field is not associated to any entity property
        'mapped' => false,

        // make it optional so you don't have to re-upload the PDF file
        // every time you edit the Product details
        'required' => false,

        // unmapped fields can't define their validation using annotations
        // in the associated entity, so you can use the PHP constraint classes
        'constraints' => [
            new File([
                'maxSize' => '1024k',
                'mimeTypes' => [
                    'image/png',
                    
                ],
                'mimeTypesMessage' => 'Please upload a valid image ',
            ])
        ],
    ])
    ->add('save',SubmitType::class,[
        'label'=>'Create',
        'attr'=>array('class'=>'btn btn-primary mt-3')
    ])
    ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        
        $maison = $form->getData();

       
        $image = $form->get('image')->getData();


        if ($image) {

            $filename = md5(uniqid().$image->guessExtension());
            $image->move(
                $this->getParameter('images_directory'),
               $filename
            );
            $maison->setImage($image);
        }


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($maison);
        $entityManager->flush();

        return $this->redirectToRoute('maison_hote_list');
    }

    return $this->render('maison_hote/new.html.twig',[

        'form'=>$form->createView()
    ]);

    }


    /**
     * @Route("/maison_hote/{id}", name="maison_hote_show")
  */

public function show($id)
{
    $maison = $this->getDoctrine()->getRepository(MaisonHote::class)->find($id);
    return $this->render('maison_hote/show.html.twig',[
       'maison'=>$maison 
    ]);
}

/**
     * @Route("/maison_hote/{id}/delete", name="maison_hote_delete")
     */
public function delete(MaisonHote $maison,Request $request){
    $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($maison);
        $entityManager->flush();
        return $this->redirectToRoute('maison_hote_list');


}

//   /**
//      * @Route("/maison_hote/save")
//   */

//   public function save(){

//     $entityManager = $this->getDoctrine()->getManager();
//     $maison = new MaisonHote ();
//     $maison -> setLocalisation('marsa');
//     $maison -> setDescription('dar kbira');
//     $maison -> setType('villa');
//     $maison -> setNombreChambres(5);
//     $maison -> setImage('no image');

//     $entityManager->persist($maison);
//     $entityManager->flush();

//         return new Response('saves a house with id of'.$maison->getId());
//   }
   
}
