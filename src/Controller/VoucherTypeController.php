<?php

namespace App\Controller;

use App\Entity\VoucherType;
use App\Form\VoucherTType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoucherTypeController extends AbstractController
{
    #[Route('/voucher/type', name: 'app_voucher_type')]
    public function index(): Response
    {
        return $this->render('voucher_type/index.html.twig', [
            'controller_name' => 'VoucherTypeController',
        ]);
    }

    #[Route('/voucher/type/create', name: 'app_voucher_type_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voucherType = new VoucherType();
        $form = $this->createForm(VoucherTType::class, $voucherType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voucherType);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('voucher_type/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
