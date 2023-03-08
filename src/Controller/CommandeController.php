<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\CategorieP;
use App\Repository\CommandeRepository;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Service\PdfService ;



class CommandeController extends AbstractController
{


    /*--------------------------------- Historique client ---------------------------------------------------*/

    /**
     * @Route("/commande", name="display_commande")
     */
    public function index(Request $request, PaginatorInterface $paginator, CommandeRepository $CommandeRepository): Response
    {

        $query = $CommandeRepository->createQueryBuilder('c')
            ->orderBy('c.dateCommande', 'ASC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            6
        );


        $em1 = $this->getDoctrine()->getManager()->getRepository(CategorieP::class); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
        $cat = $em1->findAll(); // Select * from categorieP;

        $em = $this->getDoctrine()->getManager()->getRepository(Commande::class); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
        $commande = $em->findAll();

        $success = $request->query->get('success');

        return $this->render('panier/historiqueCmd.html.twig', [
            'Commande' => $pagination,
            'listC' => $cat,
            'success' => $success
        ]);
    }
    /*--------------------------------- Historique admin ---------------------------------------------------*/

    /**
     * @Route("/historiqueCommande", name="display_commandeAdmin")
     */
    public function indexCommande(Request $request, PaginatorInterface $paginator, CommandeRepository $CommandeRepository): Response
    {

        $query = $CommandeRepository->createQueryBuilder('c')
            ->orderBy('c.dateCommande', 'ASC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            6
        );

        $em1 = $this->getDoctrine()->getManager()->getRepository(CategorieP::class); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
        $cat = $em1->findAll(); // Select * from categorieP;

        $em = $this->getDoctrine()->getManager()->getRepository(Commande::class); // ENTITY MANAGER ELY FIH FONCTIONS PREDIFINES
        $commande = $em->findAll();

        $success = $request->query->get('success');

        return $this->render('panier/historiqueAdmin.html.twig', [
            'Commande' => $pagination,
            'listC' => $cat,
            'success' => $success
        ]);
    }

    /*--------------------------------- Imprime de facture ---------------------------------------------------*/
    /**
     * @Route("/pdf/{id}", name="commande.pdf")
     */
    public function generatePdfPersonne(Commande $commande = null, PdfService $pdf)
    {
        $html = $this->render('commande/detail.html.twig', ['commande' => $commande]);
        $filename = 'commande-' . $commande->getId() . '.pdf';
        return $pdf->showPdfFile($html, $filename);
    }
}
