<?php

namespace App\Controller;

use App\Entity\Apod;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

class ApodController extends AbstractController
{
    /**
     * @Route("/", name="apod")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $client = HttpClient::create();

        $apods = $entityManager->getRepository(Apod::class)->findAll();
        if($apods == null){
            $this->fillDataBase($client, $entityManager);
        } else {
            $this->addCurrentDay($client, $entityManager);
        }

        $lastapods = $entityManager->getRepository(Apod::class)->retrieveLast30Days();

        return $this->render('apod/index.html.twig', ['apods' => $lastapods]);
    }

    private function fillDataBase($httpClient, $entityManager){
        $currentDate = date("Y-m-d");
        $this->createDBRow($httpClient, $currentDate, $entityManager);
        for($i = 1; $i <30; $i++){
            $currentDate = date("Y-m-d",  strtotime($currentDate . "-1 days"));
            $this->createDBRow($httpClient, $currentDate, $entityManager);
        }
        $entityManager->flush();
    }

    private function addCurrentDay($httpClient, $entityManager){
        $currentDate = date("Y-m-d");
        $apod = $entityManager->getRepository(Apod::class)->findOneBy(array('date' => $currentDate));
        if($apod == null){
            $this->createDBRow($httpClient, $currentDate, $entityManager);
            $entityManager->flush();
        }
    }

    private function createDBRow($httpClient, $date, $entityManager){
        $API_KEY = $_ENV['API_KEY'];
        $response = $httpClient->request('GET', 'https://api.nasa.gov/planetary/apod?api_key=' . $API_KEY . '&date=' . $date);
        $content = $response->toArray();
        $apod = new Apod();
        $apod->setDescription($content["explanation"]);
        $apod->setDate($content["date"]);
        $apod->setImage($content["url"]);
        $apod->setTitle($content["title"]);
        $entityManager->persist($apod);
    }
}
