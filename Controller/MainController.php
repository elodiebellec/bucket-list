<?php


namespace App\Controller;


use App\Entity\Wish;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/about", name="main_aboutUs")
     */
    public function aboutUs()
    {
        return $this->render('main/about.html.twig');
    }






    /**
     * @Route("/createBdd", name="main_createBdd")
     */
    public function createBdd(EntityManagerInterface $entityManager)
    {
        $wish = new Wish();
        $wish   ->setDateCreated(new \DateTime())
                ->setAuthor("Elodie")
                ->setDescription("Aprsè un déménagement, il y a du boulot")
                ->setIsPublished(true)
                ->setNote(6.0)
                ->setTitle("Ranger mes cartons");

        $entityManager->persist($wish);

        $wish2 = new Wish();
        $wish2   ->setDateCreated(new \DateTime("-6 day"))
            ->setAuthor("Jeannine")
            ->setDescription("Avec piscine et barbecue")
            ->setIsPublished(true)
            ->setNote(10.0)
            ->setTitle("S'acheter une villa aux Caraïbes");

        $entityManager->persist($wish2);

        $wish3 = new Wish();
        $wish3   ->setDateCreated(new \DateTime("-1 day"))
            ->setAuthor("Roselyne")
            ->setIsPublished(true)
            ->setNote(7.8)
            ->setTitle("Faire le grand écart");

        $entityManager->persist($wish3);

        $wish4 = new Wish();
        $wish4   ->setDateCreated(new \DateTime("-8 day"))
            ->setAuthor("Elodie")
            ->setDescription("Un BEAU site internet")
            ->setIsPublished(true)
            ->setNote(9.0)
            ->setTitle("Développer un beau site internet");

        $entityManager->persist($wish4);



        $entityManager->flush();
        dump($wish);
        dump($wish2);
        dump($wish3);
        dump($wish4);


        return $this->render('main/createBdd.html.twig', [

        ]);
    }




}