<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app")
     */
    public function index()
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

     /**
     * @Route("/about",name="about")
     */
	public function about()
    {
        return $this->render('app/about.html.twig', [
            'about_us' => 'About notre site',
        ]);
    }
     /**
     * @Route("/cgv",name="cgv")
     */
    public function cgv()
    {
        return $this->render('app/cgv.html.twig', [
            'title' => 'Conditions generales de ventes',
        ]);
    }
}
