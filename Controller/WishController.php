<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish/{page}", name="wish_list", requirements={"page"= "\d+"})
     */
    public function list(int $page = 1, WishRepository $wisheRepository): Response
    {
        //TODO Récupérer la liste des souhaits
      /*  $wisheRepository = $this->getDoctrine()->getRepository(Wish::class);
        $wishes = $wisheRepository->findBy([], ["dateCreated" => "DESC"], 50);
        //$wishes = $wisheRepository->findBestWishes();

        return $this->render('wish/list.html.twig',[
            "wishes" => $wishes
        ]);  */
        $nbWishes = $wisheRepository->count([]);
        $maxPage = ceil($nbWishes / 10);

        if($page >= 1 && $page <= $maxPage){
            $wishes = $wisheRepository->findBestWishes($page);
        }else{
            throw $this->createNotFoundException("Oops ! 404 ! This page does not exist !");
        }


        return $this->render('wish/list.html.twig', [
            "wishes" => $wishes,
            "currentPage" => $page,
            "maxPage" => $maxPage,
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

    /**
     * @Route("/wish/create", name="wish_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        //TODO Générer un formulaire pour ajouter un nouveau souhait
        $wish = new Wish();
        $wishForm = $this->createForm(WishType::class, $wish);
        $wish->setDateCreated(new \DateTime())
        ->setIsPublished(1);


        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid()){
            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'wish added !');
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }
        return $this->render('wish/create.html.twig', [
            'wishForm'=> $wishForm->createView()
        ]);

    }
}
