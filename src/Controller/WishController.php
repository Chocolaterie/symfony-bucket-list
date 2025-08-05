<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WishController extends AbstractController
{
    #[Route('/wishes', name: 'wish_list')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findAll();

        return $this->render('wish/list.html.twig', [
            'wishes' => $wishes,
        ]);
    }

    #[Route('/wishes/{id}', name: 'wish_detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail(int $id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);

        if(!$wish){
            throw $this->createNotFoundException("Le souhait n'existe pas.");
        }

        return $this->render('wish/detail.html.twig', [
            'wish' => $wish,
        ]);
    }

    #[Route('/wish-create', name: 'wish_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $wish = new Wish();

        $form = $this->createForm(WishType::class, $wish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Publié par défaut
            $wish->setIsPublished(true);
            // Date = Now
            $wish->setDateCreated(new \DateTimeImmutable("now"));

            $em->persist($wish);
            $em->flush();

            $this->addFlash("success", "Le voeux a été crée avec succès");

            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->render('wish/create.html.twig', [
            'wishForm' => $form->createView(),
        ]);
    }


}
