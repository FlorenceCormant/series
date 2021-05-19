<?php


namespace App\Controller;


use App\Entity\Serie;
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
     * @Route("/test", name="main_test")
     */
    public function test(EntityManagerInterface $entityManager)
    {

        //autre possibilité pour récupérer l'instance de l'entityManager
        //$entityManager = $this->getDoctrine()->getManager();

        $serie = new Serie();

        $serie->setBackdrop("lfkjgldfkjg")
            ->setDateCreated(new \DateTime())
            ->setFirstAirDate(new \DateTime("-1 year"))
            ->setGenres("Western")
            ->setLastAirDate(new \DateTime("-6 month"))
            ->setName("Lucky Luke")
            ->setPopularity(100.8)
            ->setPoster("lksjdflksjdf")
            ->setStatus("Returning")
            ->setTmdbId(123456)
            ->setVote(9.8);

        $serie2 = new Serie();

        $serie2->setBackdrop("lfkjgldfkjg")
            ->setDateCreated(new \DateTime())
            ->setFirstAirDate(new \DateTime("-1 year"))
            ->setGenres("Western")
            ->setLastAirDate(new \DateTime("-6 month"))
            ->setName("Dalton")
            ->setPopularity(100.8)
            ->setPoster("lksjdflksjdf")
            ->setStatus("Returning")
            ->setTmdbId(123456)
            ->setVote(9.8);



        dump($serie);

        $entityManager->persist($serie);
        $entityManager->persist($serie2);
        $entityManager->flush();


        $serie->setName("Calamity Jane");
        $entityManager->persist($serie);
        $entityManager->flush();

        dump($serie);

        $entityManager->remove($serie);
        $entityManager->flush();

        $series = [];

        return $this->render('main/test.html.twig', [

        ]);
    }


}