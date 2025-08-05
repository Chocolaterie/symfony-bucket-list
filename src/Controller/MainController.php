<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Wish;
use App\Form\CourseType;
use App\Form\WishType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'main_home', methods: ['GET']), ]
    public function home() : Response {
        return $this->render('main/home.html.twig');
    }

    #[Route('/about-us', name: 'main_aboutus', methods: ['GET']), ]
    public function aboutUs() : Response {
        return $this->render('main/about_us.html.twig');
    }
}