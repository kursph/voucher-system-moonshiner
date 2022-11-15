<?php

namespace App\Controller;

use App\Entity\Voucher;

use App\Form\VoucherEType;
use App\Form\VoucherType;
use App\Service\RuleEngine;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoucherController extends AbstractController
{
    #[Route('/voucher/create', name: 'app_voucher_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voucher = new Voucher();
        $form = $this->createForm(VoucherEType::class, $voucher);
        $form->handleRequest($request);

        $ruleEngine = new RuleEngine();

        if ($form->isSubmitted() && $form->isValid()) {
            $errorMessage = $ruleEngine->validateAny($voucher->getType());

            if ($ruleEngine->validateAny($voucher->getType()) == null) {
                $entityManager->persist($voucher);
                $entityManager->flush();

                $this->addFlash('success', 'Voucher Created!');
            } else {
                $this->addFlash('error', 'Voucher Not Created! ' . $errorMessage);
            }

            return $this->redirectToRoute('app_index');
        }

        return $this->render('voucher/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
