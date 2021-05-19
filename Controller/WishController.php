<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish_list")
     */
    public function list(): Response
    {
        //TODO Récupérer la liste des souhaits
        return $this->render('wish/list.html.twig',[
        ]);
    }

    /**
     * @Route("/wish/detail/{id}", name="wish_detail")
     */
    public function detail($id): Response
    {
        //TODO Récupérer le détail du souhait
        return $this->render('wish/detail.html.twig', [
        ]);
    }
}
