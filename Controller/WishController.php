<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
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
        $wisheRepository = $this->getDoctrine()->getRepository(Wish::class);
        $wishes = $wisheRepository->findBy([], ["dateCreated" => "DESC"], 50);
        //$wishes = $wisheRepository->findBestWishes();

        return $this->render('wish/list.html.twig',[
            "wishes" => $wishes
        ]);
    }

    /**
     * @Route("/wish/detail/{id}", name="wish_detail")
     */
    public function detail($id, WishRepository $wishRepository): Response
    {
        //TODO Récupérer le détail du souhait
        $wish = $wishRepository->find($id);
        if(!$wish){
            throw $this->createNotFoundException("Ooops ! This wish does not exist !");
        }
        return $this->render('wish/detail.html.twig', [
            "wish" => $wish
        ]);
    }
}
