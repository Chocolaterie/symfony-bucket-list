<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WishController extends AbstractController
{
    #[Route('/wishes', name: 'wish_list')]
    public function list(): Response
    {
        $wishes = [
            'Sauter en parachute',
            'Gagner au loto'
        ];

        return $this->render('wish/list.html.twig', [
            'wishes' => $wishes,
        ]);
    }

    #[Route('/wishes/{id}', name: 'wish_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        $wishes = [
            'Sauter en parachute',
            'Gagner au loto'
        ];

        return $this->render('wish/detail.html.twig', [
            'wish' => $wishes[$id],
            'id' => $id,
        ]);
    }



}
