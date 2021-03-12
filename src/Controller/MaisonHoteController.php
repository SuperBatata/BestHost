<?php

namespace App\Controller;





use App\Entity\MaisonHote;
use App\Entity\MaisonImages;
use App\Entity\MaisonRecherche;
use App\Form\MaisonHoteType;
use App\Form\MaisonRechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;

class MaisonHoteController extends AbstractController
{



    /**
     * @Route("/maison_hote", name="maison_hote_list" ,methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $search = new MaisonRecherche();

        $form = $this->createForm(MaisonRechercheType::class, $search);

        $form->handleRequest($request);

        $maison = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $nom = $search->getNom();
            if ($nom != "")
                $maison = $this->getDoctrine()->getRepository(MaisonHote::class)->findBy(['nom' => $nom]);
            else
                $maison = $this->getDoctrine()->getRepository(MaisonHote::class)->findAll();
        }

        //  $maison = $this->getDoctrine()->getRepository(MaisonHote::class)->findall($search);


        return $this->render('maison_hote/index.html.twig', [
            'maisons' => $maison,
            'form' => $form->createView()

        ]);
    }



    /**
     * @Route("/maison_hote/new", name="new_maison_hote")
     * Method({"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $maison = new MaisonHote();
        $form = $this->createForm(MaisonHoteType::class, $maison)
            ->add('save', SubmitType::class, [
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();
            foreach ($images as $image) {
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move(
                    $this->getParameter('images_direcoty'),
                    $fichier
                );

                $img = new MaisonImages();
                $img->setName($fichier);
                $maison->addImage($img);
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($maison);
            $entityManager->flush();

            return $this->redirectToRoute('maison_hote_list');
        }

        return $this->render('maison_hote/new.html.twig', [
            'maison' => $maison,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/maison_hote/{id}", name="maison_hote_show")
     */

    public function show($id)
    {
        $maison = $this->getDoctrine()->getRepository(MaisonHote::class)->find($id);
        return $this->render('maison_hote/show.html.twig', [
            'maison' => $maison
        ]);
    }

    /**
     *  @Route("/maison_hote/{id}/edit", name="edit_maison_hote") , methode={"GET","POST"}  
     */
    public function edit(Request $request, MaisonHote $maison)
    {
        $form = $this->createForm(MaisonHoteType::class, $maison)
            ->add('save new edit', SubmitType::class, [
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ]);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();
            foreach ($images as $image) {
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move(
                    $this->getParameter('images_direcoty'),
                    $fichier
                );

                $img = new MaisonImages();
                $img->setName($fichier);
                $maison->addImage($img);
            }
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('maison_hote_list');
        }

        return $this->render('maison_hote/edit.html.twig', [
            'maison' => $maison,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/maison_hote/{id}/delete", name="maison_hote_delete")
     */
    public function delete(MaisonHote $maison, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($maison);
        $entityManager->flush();
        return $this->redirectToRoute('maison_hote_list');
    }

    /**
     * @Route("/maison_hote/supprime/image/{id}" , name="maison_hote_delete_image", methods={"DELETE"})
     */
    public function deleteImage(MaisonImages $image, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])) {
            // On récupère le nom de l'image
            $nom = $image->getName();
            // On supprime le fichier
            unlink($this->getParameter('images_directory') . '/' . $nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
   
}
