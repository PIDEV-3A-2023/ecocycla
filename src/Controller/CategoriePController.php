<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\CategoriePType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CategorieP;
use App\Form\ProduitType ;

class CategoriePController extends AbstractController
{
    #[Route('/categoriep', name: 'display_categorie')]
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager()->getRepository(CategorieP::class); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES

        $categorie = $em->findAll(); // Select * from categorie;
        return $this->render('categorie_P/index.html.twig', ['listC'=>$categorie]);
    }
    #[Route('/ajouterCategorie', name: 'ajouterCategorie')]
    public function ajouterCategorie(Request $request): Response
    {

        $categorie = new CategorieP(); // init objet
        $form = $this->createForm(CategoriePType::class,$categorie);

        $form->handleRequest($request); // bch man5srhomich ya3ni les donnees yab9o persisté



        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
            $em->persist($categorie);//ajout
            $em->flush();// commit

            return $this->redirectToRoute('ajouterCategorie');

        }

        return $this->render('categorie_P/createcategorie.html.twig',
            ['f'=>$form->createView()]
        );
    }

    #[Route('/modifierCategorie/{id}', name: 'modifierCategorie')]
    public function modifierCategorie(Request $request,$id): Response
    {
        $categorie= $this->getDoctrine()->getManager()->getRepository(CategorieP::class)->find($id);

        $form = $this->createForm(CategoriePType::class,$categorie);

        $form->handleRequest($request); // bch man5srhomich ya3ni les donnees yab9o persisté



        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
            $em->persist($categorie);//ajout
            $em->flush();// commit

            return $this->redirectToRoute('display_categorie');

        }

        return $this->render('categorie_P/modifiercategorie.html.twig',
            ['f'=>$form->createView()]
        );
    }
    #[Route('/supprimerCategorie/{id}', name: 'supprimeCategorie')]
    public function suppressionCategorie(CategorieP  $categorie): Response
    {

        $em = $this->getDoctrine()->getManager();// ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
        $em->remove($categorie);
        //MISE A JOURS
        $em->flush();

        return $this->redirectToRoute('display_categorie');
    }

    /**
     * @Route("/categorie/{id}", name="produits_par_categorie")
     */
    public function produitsParCategorie(CategorieP $idcatP)
    {
        $categories = $this->getDoctrine()
            ->getRepository(CategorieP::class)
            ->findAll();
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findBy(['idcatP' => $idcatP]);

        return $this->render('categorie_P/ShowProductsByCat.html.twig', [
            'idcatP' => $idcatP,
            'produits' => $produits,
            'cat'=> $categories
        ]);
    }



}
